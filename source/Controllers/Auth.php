<?php


namespace Source\Controllers;


use League\OAuth2\Client\Provider\Facebook;
use League\OAuth2\Client\Provider\FacebookUser;
use League\OAuth2\Client\Provider\Google;
use League\OAuth2\Client\Provider\GoogleUser;
use Source\Core\Controller;
use Source\Models\User;
use Source\Support\Email;

class Auth extends Controller
{
    /**
     * Auth constructor.
     * @param $router
     */
    public function __construct($router)
    {
        parent::__construct($router);
    }

    /**
     * @param array $data
     */
    public function login(array $data): void
    {
        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $passwd = filter_var($data["passwd"], FILTER_DEFAULT);

        if (!$email || !$passwd){
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe seus dados para logar!"
            ]);
            return;
        }
        $user = (new User())->find("email = :email", "email={$email}")->fetch();
        if (!$user || !password_verify($passwd, $user->senha)){
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "E-mail ou senha invalida!"
            ]);
            return;
        }

        /*
         * social validate
         */

        $this->socialValidate($user);


        $_SESSION["user"] = $user->id;
        echo $this->ajaxResponse("redirect", ["url" => $this->router->route("app.home")]);
    }

    /**
     * @param $data
     */
    public function register($data): void
    {
        $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
        if (in_array("", $data)){
            echo $this->ajaxResponse("message",[
                "type" => "error",
                "message" => "Informe todos os campos para cadastrar!"
            ]);
            return;
        }

        $user = new User();
        $user->nome = $data["first_name"];
        $user->sobrenome = $data["last_name"];
        $user->email = $data["email"];
        $user->senha = password_hash($data["passwd"], PASSWORD_DEFAULT);

        /*
         * social validate
         */
        $this->socialValidate($user);

        if (!$user->save()){
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $user->fail()->getMessage()
            ]);
            return;
        }

        $_SESSION["user"] = $user->id;
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("app.home")
        ]);

    }

    /**
     * @param $data
     */
    public function forget($data): void
    {
        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        if (!$email){
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe seu E-mail para recuperar a senha!"
            ]);
            return;
        }
        $user = (new User())->find("email = :e", "e={$email}")->fetch();
        if (!$user){
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Informe um E-mail valido!"
            ]);
            return;
        }

        $user->forget = (md5(uniqid(rand(), true)));
        $user->save();

        $_SESSION["forget"] = $user->id;

        $email = new Email();
        $email->add(
            "Recupe sua senha | ". site("name"),
            $this->view->render("emails/recover", [
                "user" => $user,
                "link" => $this->router->route("web.reset", [
                    "email" => $user->email,
                    "forget" => $user->forget
                ])
            ]),
            "{$user->nome} {$user->sobrenome}",
            $user->email
        )->send();

        flash("success", "Enviamos um link de recuperação para seu E-mail");

        echo $this->ajaxResponse("redirect",[
            "url" => $this->router->route("web.forget")
        ]);
    }

    /**
     * @param $data
     */
    public function reset($data): void
    {
        if (empty($_SESSION["forget"]) || !$user = (new User())->findById($_SESSION["forget"])){
            flash("error", "Não foi possivel recuperar, tente novamente");
            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("web.forget")
            ]);
            return;
        }

        if (empty($data["password"]) || empty($data["password_re"])){
            echo $this->ajaxResponse("message", [
                "type" => "alert",
                "message" => "Informe e repita a nova senha"
            ]);
            return;
        }

        if ($data["password"] <> $data["password_re"]){
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => "Você informou duas senha diferentes"
            ]);
            return;
        }

        $user->senha = password_hash($data["password"], PASSWORD_DEFAULT);
        $user->forget = null;

        if (!$user->save()){
            echo $this->ajaxResponse("message", [
                "type" => "error",
                "message" => $user->fail()->getMessage()
            ]);
            return;
        }

        unset($_SESSION["forget"]);

        flash("success", "Sua senha foi atualizada com sucesso");
        echo $this->ajaxResponse("redirect", [
            "url" => $this->router->route("web.login")
        ]);
    }

    /**
     *
     */
    public function facebook(): void
    {
        $facebook = new Facebook(FACEBOOK_LOGIN);
        $error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRIPPED);
        $code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRIPPED);

        if (!$error && !$code){
            $auth_url = $facebook->getAuthorizationUrl(["scope" => "email"]);
            header("Location: {$auth_url}");
            return;
        }
        if ($error){
            flash("error", "Não foi possivel logar com o Facebook");
            $this->router->redirect("web.login");
        }

        if ($code && empty($_SESSION["facebook_auth"])){
            try{
                $token = $facebook->getAccessToken("authorization_code", ["code" => $code]);
                $_SESSION["facebook_auth"] = serialize($facebook->getResourceOwner($token));
            }catch (\Exception $exception){
                flash("error","Não foi possivel se conectar com o Facebbok");
                $this->router->redirect("web.login");
            }
        }

        /** @var $facebook_user FacebookUser */
        $facebook_user = unserialize($_SESSION["facebook_auth"]);
        $user_by_id = (new User())->find("facebook_id = :id", "id={$facebook_user->getId()}")->fetch();

        //login facebook
        if ($user_by_id){
            unset($_SESSION["facebook_auth"]);

            $_SESSION["user"] = $user_by_id->id;
            $this->router->redirect("app.home");
        }

        //login e-mmail
        $user_by_email = (new User())->find("email = :e", "e={$facebook_user->getEmail()}")->fetch();
        if ($user_by_email){
            flash("info", "Olá {$facebook_user->getFirstName()}, faça login para conectar seu Facebook");
            $this->router->redirect("web.login");
        }

        //register if not
        $link = $this->router->route("web.login");
        flash("info",
            "Olá {$facebook_user->getFirstName()}, <b>se já tem uma conta clique em <a title='Fazer login' href='{$link}'>FAZER LOGIN</a></b>, ou complete seu cadastro");
        $this->router->redirect("web.register");


    }

    public function google(): void
    {
        $google = new Google(GOOGLE_LOGIN);
        $error = filter_input(INPUT_GET, "error", FILTER_SANITIZE_STRIPPED);
        $code = filter_input(INPUT_GET, "code", FILTER_SANITIZE_STRIPPED);

        if (!$error && !$code){
            $auth_url = $google->getAuthorizationUrl();
            header("Location: {$auth_url}");
            return;
        }
        if ($error){
            flash("error", "Não foi possivel logar com o Google");
            $this->router->redirect("web.login");
        }

        if ($code && empty($_SESSION["google_auth"])){
            try{
                $token = $google->getAccessToken("authorization_code", ["code" => $code]);
                $_SESSION["google_auth"] = serialize($google->getResourceOwner($token));
            }catch (\Exception $exception){
                flash("error","Não foi possivel se conectar com o Google");
                $this->router->redirect("web.login");
            }
        }

        /** @var $facebook_user FacebookUser */
        $google_user = unserialize($_SESSION["google_auth"]);
        $user_by_id = (new User())->find("google_id = :id", "id={$google_user->getId()}")->fetch();

        //login facebook
        if ($user_by_id){
            unset($_SESSION["google_auth"]);

            $_SESSION["user"] = $user_by_id->id;
            $this->router->redirect("app.home");
        }

        //login e-mmail
        $user_by_email = (new User())->find("email = :e", "e={$google_user->getEmail()}")->fetch();
        if ($user_by_email){
            flash("info", "Olá {$google_user->getFirstName()}, faça login para conectar o Google");
            $this->router->redirect("web.login");
        }

        //register if not
        $link = $this->router->route("web.login");
        flash("info",
            "Olá {$google_user->getFirstName()}, <b>se já tem uma conta clique em <a title='Fazer login' href='{$link}'>FAZER LOGIN</a></b>, ou complete seu cadastro!");
        $this->router->redirect("web.register");

    }

    public function socialValidate(User $user): void
    {
        if (!empty($_SESSION["facebook_auth"])){
            /** @var $facebook_user FacebookUser*/
            $facebook_user = unserialize($_SESSION["facebook_auth"]);

            $user->facebook_id = $facebook_user->getId();
            $user->foto = $facebook_user->getPictureUrl();
            $user->save();

            unset($_SESSION["facebook_auth"]);
        }
        if (!empty($_SESSION["google_auth"])){
            /** @var $google_user GoogleUser*/
            $google_user = unserialize($_SESSION["google_auth"]);

            $user->google_id = $google_user->getId();
            $user->foto = $google_user->getAvatar();
            $user->save();

            unset($_SESSION["google_auth"]);
        }
    }
}