<?php


namespace Source\Controllers;


use Source\Core\Controller;
use Source\Models\User;

/**
 * Class Web
 * @package Source\Controllers
 */
class Web extends Controller
{
    /**
     * Web constructor.
     * @param $router
     */
    public function __construct($router)
    {
        parent::__construct($router);

        if (!empty($_SESSION["user"])){
            $this->router->redirect("app.home");
        }
    }

    /**
     *
     */
    public function login(): void
    {
        $head = $this->seo->optimize(
          "Crie sua conta no". site("name"),
          site("desc"),
          $this->router->route("web.login"),
          routeImage("Login"),
        )->render();
        echo $this->view->render("theme/login/login",[
            "head" => $head
        ]);
    }

    /**
     *
     */
    public function cadastrar(): void
    {
        $head = $this->seo->optimize(
            "Crie sua conta no". site("name"),
            site("desc"),
            $this->router->route("web.cadastrar"),
            routeImage("Register"),
            )->render();

        $form_user = new \stdClass();
        $form_user->first_name = null;
        $form_user->last_name = null;
        $form_user->email = null;

        $socialUser = (!empty($_SESSION["facebook_auth"]) ? unserialize($_SESSION["facebook_auth"]) :
            (!empty($_SESSION["google_auth"]) ? unserialize($_SESSION["google_auth"]) : null));
        if ($socialUser){
            $form_user->first_name = $socialUser->getFirstName();
            $form_user->last_name = $socialUser->getLastName();
            $form_user->email = $socialUser->getEmail();
        }

        echo $this->view->render("theme/login/cadastrar",[
            "head" => $head,
            "user" => $form_user
        ]);
    }

    /**
     *
     */
    public function forget(): void
    {
        $head = $this->seo->optimize(
            "Recupere sua Senha | ". site("name"),
            site("desc"),
            $this->router->route("web.forget"),
            routeImage("Forget"),
            )->render();
        echo $this->view->render("theme/login/forget",[
            "head" => $head
        ]);
    }

    /**
     * @param $data
     */
    public function reset($data): void
    {
        if (empty($_SESSION["forget"])){
            flash("info", "Informe seu E-mail para recuperar a senha");
            $this->router->route("web.forget");
        }


        $erForget = "Não foi possivel recuperar, tente novamente";

        $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
        $forget = filter_var($data["forget"], FILTER_DEFAULT);

        if (!$email || !$forget){
            flash("error", $erForget);
            $this->router->route("web.forget");
        }
        $user = (new User())->find("email = :e AND forget = :f", "e={$email}&f={$forget}")->fetch();

        if (!$user){
            flash("error", $erForget);
            $this->router->route("web.forget");
        }

        $head = $this->seo->optimize(
            "Crie sua nova senha | ". site("name"),
            site("desc"),
            $this->router->route("web.reset"),
            routeImage("Reset"),
            )->render();
        echo $this->view->render("theme/login/reset",[
            "head" => $head
        ]);
    }

    /**
     * @param $data
     */
    public function error($data): void
    {
        $error = filter_var($data["errcode"], FILTER_VALIDATE_INT);

        $head = $this->seo->optimize(
            "Oopss {$error} | ". site("name"),
            site("desc"),
            $this->router->route("web.error", ["errcode" => $error]),
            routeImage("ERROR"),
            )->render();
        echo $this->view->render("theme/error",[
            "head" => $head,
            "error" => $error
        ]);
    }
}