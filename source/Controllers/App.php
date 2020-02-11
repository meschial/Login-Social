<?php


namespace Source\Controllers;

use CoffeeCode\Uploader\Image;
use Source\Core\Controller;
use Source\Models\Comentario;
use Source\Models\DadosUser;
use Source\Models\Endereco;
use Source\Models\Motorista;
use Source\Models\User;

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

    public function meusdados()
    {
        $head = $this->seo->optimize(
            "Comentarios",
            site("desc"),
            $this->router->route("app.meusdados"),
            routeImage("meusdados")
        )->render();

        echo $this->view->render("theme/usuario/comentario",[
            "head" => $head,
            "user" => $this->user,
        ]);
    }

    public function motorista($data)
    {//id	tipo_cnh	cnh	foto	ativo	login_id
        if (!empty($data)){
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            if (in_array("", $data)){
                flash("info", "{$this->user->nome}, informe todos os campos!");
                $this->router->redirect("app.motorista");
                return;
            }
        }
        if (!empty($_FILES)){
            $upload = new Image("img", "motorista");

            if (!empty($_FILES["fileUpload"])){
                $file = $_FILES["fileUpload"];
                if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())){
                    flash("success", "{$this->user->nome}, Deu ruim kkk!");
                    $this->router->redirect("app.motorista");
                    return;
                }else{
                    $uploaded =  $upload->upload($file, pathinfo($_SESSION["user"], PATHINFO_FILENAME), 1920);
                    $motos = (new Motorista())->find("login_id = :login_id", "login_id={$_SESSION["user"]}")->fetch(true);

                    if ($motos){
                        foreach ($motos as $moto) {
                            $motos = ($moto->id);
                        }
                        $moto = (new Motorista())->findById($motos);
                        $moto->tipo_cnh = $data["tipo_cnh"];
                        $moto->cnh = $data["cnh"];
                        $moto->foto = $uploaded;
                        $moto->ativo = "N";
                        $moto->save();
                        flash("success", "{$this->user->nome}, eu acho q atualizou kk olha la!!");
                        $this->router->redirect("app.motorista");
                    }else{
                        $mot = new Motorista();
                        $mot->tipo_cnh = $data["tipo_cnh"];
                        $mot->cnh = $data["cnh"];
                        $mot->foto = $uploaded;
                        $mot->ativo = "N";
                        $mot->login_id = $_SESSION["user"];
                        $mot->save();
                        flash("success", "{$this->user->nome}, eu acho q salvou kk olha la!!");
                        $this->router->redirect("app.motorista");
                    }
                }
            }
        }

        $head = $this->seo->optimize(
            "Comentarios",
            site("desc"),
            $this->router->route("app.meusdados"),
            routeImage("meusdados")
        )->render();

        $login_id = $_SESSION["user"];
        $mot = new Motorista();
        $motorista = $mot->find("login_id = :login_id", "login_id={$login_id}")->fetch(true);
        if ($motorista){
            foreach ($motorista as $teste){
                $userc = new \stdClass();
                $userc->tipo_cnh = $teste->tipo_cnh;
                $userc->cnh = $teste->cnh;
                $userc->foto = $teste->foto;
            }
        }else{
            $userc = new \stdClass();
            $userc->tipo_cnh = null;
            $userc->cnh = null;
        }

        echo $this->view->render("theme/usuario/motorista",[
            "head" => $head,
            "user" => $this->user,
            "userc" => $userc
        ]);
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
            $end->login_id = $_SESSION["user"];
            $end->save();

            if ($end->save()){
                flash("success", "{$this->user->nome}, seu endereço foi salvo com sucesso!");

                echo $this->ajaxResponse("redirect",[
                    "url" => $this->router->route("app.endereco")
                ]);
                return;
            }else{
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => $end->fail()->getMessage()
                ]);
                return;
            }
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
            $foto = (new User())->find("id = :id", "id={$_SESSION["user"]}")->fetch(true);

            foreach ($foto as $item){
                $foto = ($item->foto);
                $nome = ($item->nome);
            }
            if (empty($foto)){
                $foto = "https://gclaw.com.br/wp-content/themes/tema-gclaw-2017/assets/images/sem-foto.jpg";
            }
            $com = new Comentario();
            $com->titulo = $data["titulo"];
            $com->texto = $data["texto"];
            $com->nome = $nome;
            $com->foto = $foto;
            $com->login_id = $_SESSION["user"];
            $com->save();
            if (!$com->save()){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => $com->fail()->getMessage()
                ]);
                return;
            }else{
                flash("success", "Olá {$nome}, sua opnião foi registrada com sucesso!");
                echo $this->ajaxResponse("redirect", [
                    "url" => $this->router->route("app.comentario")
                ]);
                return;
            }
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
                    "message" => "Informe todos os campos!"
                ]);
                return;
            }
                $user = new DadosUser();
                $users = $user->find("login_id = :login_id", "login_id={$_SESSION["user"]}")->fetch(true);
            if ($users){
                foreach ($users as $item) {
                    $novo = $item->id;
                }
                $user = (new DadosUser())->findById($novo);
                $user->cpf = $data["cpf"];
                $user->rg = $data["rg"];
                $user->date = $data["date"];
                $user->celular = $data["celular"];
                $user->save();

                if ($user->save()){
                    flash("success", "Seus dados foram atualizados {$this->user->nome}!");
                    echo $this->ajaxResponse("redirect",[
                        "url" => $this->router->route("app.documentos")
                    ]);
                    return;
                }else{
                    echo $this->ajaxResponse("message", [
                        "type" => "error",
                        "message" => $user->fail()->getMessage()
                    ]);
                    return;
                }
            }else{
                //cpf	rg	date	tipo	celular	ativo	login_id
                $user = new DadosUser();
                $user->cpf = $data["cpf"];
                $user->rg = $data["rg"];
                $user->date = $data["date"];
                $user->celular = $data["celular"];
                $user->login_id = $_SESSION["user"];
                $user->save();

                if ($user->save()){
                    flash("success", "{$this->user->nome}, Seus dados foram salvos!");

                    echo $this->ajaxResponse("redirect",[
                        "url" => $this->router->route("app.documentos")
                    ]);
                    return;
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
            $user = new DadosUser();
            $userss = $user->find("login_id = :login_id", "login_id={$login_id}")->fetch(true);
        if ($userss){
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
        echo $this->view->render("theme/usuario/documentos",[
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