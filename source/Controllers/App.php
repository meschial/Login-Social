<?php


namespace Source\Controllers;


use Source\Core\Controller;
use Source\Models\Comentario;
use Source\Models\Endereco;
use Source\Models\User;
use Source\Models\Usuario;

/**
 * Class App
 * @package Source\Controllers
 */
class App extends Controller
{
    /* @var \Source\Models\User */
    protected $user;

    /**
     * App constructor.
     * @param $router
     */
    public function __construct($router)
    {
        parent::__construct($router);

        if (empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])){
            unset($_SESSION["user"]);

            flash("error", "Acesso negado.");
            $this->router->redirect("web.login");
        }
        //RESTRIÇÃO DE ACESSO
    }


    /**
     *
     */
    public function iniciocliente():void
    {
        $head = $this->seo->optimize(
            "Bem vindo(a)",
            site("desc"),
            $this->router->route("app.iniciocliente"),
            routeImage("Cliente")
        )->render();

        echo $this->view->render("theme/usuario/iniciocliente",[
            "head" => $head,
            "user" => $this->user,
        ]);

    }

    /**
     * @param array $data
     */
    public function endereco(array $data): void
    {
        if (!empty($data)){
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            if (in_array("", $data)){
                echo $this->ajaxResponse("message",[
                    "type" => "error",
                    "message" => "informe todos os campos!"
                ]);
                return;
            }//id	cep	rua	complemento	bairro	cidade	estado	numero	usuario_id
            $end = new Endereco();
            $end->cep = $data["cep"];
            $end->rua = $data["rua"];
            $end->complemento = $data["complemento"];
            $end->bairro = $data["bairro"];
            $end->cidade = $data["cidade"];
            $end->estado = $data["estado"];
            $end->numero = $data["numero"];
            $end->usuario_id = $_SESSION["user"];
            $end->save();
            if (!$end->save()){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => $end->fail()->getMessage()
                ]);
                return;
            }else{
                echo $this->ajaxResponse("redirect", [
                    "url" => $this->router->route("app.endereco")
                ]);
            }
            return;
        }

        $head = $this->seo->optimize(
            "Cadastro de endereço",
            site("desc"),
            $this->router->route("app.endereco"),
            routeImage("Endereço")
        )->render();

        echo $this->view->render("theme/usuario/endereco",[
            "head" => $head,
            "user" => $this->user,
        ]);
    }

    public function cartao()
    {
        $head = $this->seo->optimize(
            "Comentarios",
            site("desc"),
            $this->router->route("app.comentario"),
            routeImage("Comentario")
        )->render();

        echo $this->view->render("theme/usuario/cartao",[
            "head" => $head,
            "user" => $this->user,
        ]);
    }

    public function comentario(array $data):void
    {
        if (!empty($data)){
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            if (in_array("", $data)){
                echo $this->ajaxResponse("message",[
                    "type" => "error",
                    "message" => "informe todos os campos!"
                ]);
                return;
            }//	id	titulo	texto	date    foto	usuario_id
            $foto = (new User())->find("id = :u", "u={$_SESSION["user"]}")->fetch(true);

            foreach ($foto as $item){
                $foto = ($item->foto);
                $nome = ($item->nome);
            }

            $com = new Comentario();
            $com->titulo = $data["titulo"];
            $com->texto = $data["texto"];
            $com->nome = $nome;
            $com->foto = $foto;
            $com->usuario_id = $_SESSION["user"];
            $com->save();
            if (!$com->save()){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => $com->fail()->getMessage()
                ]);
                return;
            }else{
                echo $this->ajaxResponse("redirect", [
                    "url" => $this->router->route("app.comentario")
                ]);
            }
            return;
        }
        //id	titulo	texto	date    foto	usuario_id
        $head = $this->seo->optimize(
            "Comentarios",
            site("desc"),
            $this->router->route("app.comentario"),
            routeImage("Comentario")
        )->render();

        echo $this->view->render("theme/usuario/comentario",[
            "head" => $head,
            "user" => $this->user,
        ]);

    }

    /**
     *
     */
    public function home(array $data): void
    {
        if (!empty($data)){
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            if (in_array("", $data)){
                echo $this->ajaxResponse("message",[
                    "type" => "error",
                    "message" => "Informe todos os campos para cadastrar!"
                ]);
                return;
            }
            $login_id = $_SESSION["user"];
            $usere = (new Usuario())->find("login_id = :login_id", "login_id={$login_id}")->count();

            if ($usere){
                $user = new Usuario();
                $userss = $user->find("login_id = :login_id", "login_id={$login_id}")->fetch(true);
                foreach ($userss as $item) {
                    $novo = $item->id;
                }
                $user = (new Usuario())->findById($novo);
                $user->cpf = $data["cpf"];
                $user->rg = $data["rg"];
                $user->date = $data["date"];
                $user->celular = $data["celular"];
                $user->save();
                echo $this->ajaxResponse("redirect", [
                    "url" => $this->router->route("app.meusdados")

                ]);
                return;
            }else{
                //cpf	rg	date	tipo	celular	ativo	login_id
                $user = new Usuario();
                $user->cpf = $data["cpf"];
                $user->rg = $data["rg"];
                $user->date = $data["date"];
                $user->tipo = "1";
                $user->celular = $data["celular"];
                $user->ativo = "n";
                $user->login_id = $_SESSION["user"];
                $user->save();

                if ($user->save()){
                    echo $this->ajaxResponse("redirect", [
                        "url" => $this->router->route("app.meusdados")
                    ]);
                }else{
                    echo $this->ajaxResponse("message", [
                        "type" => "error",
                        "message" => $user->fail()->getMessage()
                    ]);
                    return;
                }
            }
        }

        $head = $this->seo->optimize(
            "Bem vindo(a) {$this->user->nome} | ". site("name"),
            site("desc"),
            $this->router->route("app.home"),
            routeImage("Conta de {$this->user->nome}"),
            )->render();

        $login_id = $_SESSION["user"];
        $usere = (new Usuario())->find("login_id = :login_id", "login_id={$login_id}")->count();

        $userc = "";
        if ($usere){
            $user = new Usuario();
            $userss = $user->find("login_id = :login_id", "login_id={$login_id}")->fetch(true);
            foreach ($userss as $teste){
                $userc = new \stdClass();
                $userc->cpf = $teste->cpf;
                $userc->rg = $teste->rg;
                $userc->date = $teste->date;
                $userc->celular = $teste->celular;
            }
        }else{
            $userc = new \stdClass();
            $userc->cpf = null;
            $userc->rg = null;
            $userc->date = null;
            $userc->celular = null;
        }
        echo $this->view->render("theme/usuario/meusdados",[
            "head" => $head,
            "user" => $this->user,
            "userc" => $userc
        ]);
    }

    /**
     *Sair
     */
    public function logoff(): void
    {
        unset($_SESSION["user"]);

        flash("info", "Você saiu com sucesso, volte logo {$this->user->nome}!");
        $this->router->redirect("web.login");

    }
}