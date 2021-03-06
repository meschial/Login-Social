<?php


namespace Source\Controllers;

use CoffeeCode\Uploader\Image;
use Source\Core\Controller;
use Source\Models\Comentario;
use Source\Models\ContrataRota;
use Source\Models\DadosUser;
use Source\Models\Endereco;
use Source\Models\Motorista;
use Source\Models\NovaRota;
use Source\Models\Teste;
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

    /**
     *
     */
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

    /**
     * @param $data
     * @throws \Exception
     */
    public function motorista($data)
    {//id	tipo_cnh	cnh	foto	ativo	login_id
        if (!empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            if (in_array("", $data)) {
                flash("info", "{$this->user->nome}, informe todos os campos!");
                $this->router->redirect("app.motorista");
                return;
            }

            $motos = (new Motorista())->find("login_id = :login_id", "login_id={$_SESSION["user"]}")->fetch(true);
                foreach ($motos as $moto) {
                   $mot = ($moto->id);
                   $foto = ($moto->foto);
                   unlink($foto);
                }

            if ($mot) {
                $moto = (new Motorista())->findById($mot);
                $moto->tipo_cnh = $data["tipo_cnh"];
                $moto->cnh = $data["cnh"];
                $moto->ativo = "N";
            } else{
                $moto = new Motorista();
                $moto->tipo_cnh = $data["tipo_cnh"];
                $moto->cnh = $data["cnh"];
                $moto->ativo = "N";
                $moto->login_id = $_SESSION["user"];
            }
            if (!empty($_FILES)) {
                $upload = new Image("img", "motorista");
                if (!empty($_FILES["fileUpload"])) {
                    $file = $_FILES["fileUpload"];
                    if (empty($file["type"]) || !in_array($file["type"], $upload::isAllowed())) {
                        flash("info", "{$this->user->nome}, Informe a foto da sua CNH!");
                        $this->router->redirect("app.motorista");
                        return;
                    } else {
                        $uploaded = $upload->upload($file, pathinfo($_SESSION["user"], PATHINFO_FILENAME), 1920);
                        $moto->foto = $uploaded;
                    }
                }
            }
            if ($moto->save()){
                flash("success", "{$this->user->nome}, Dados salvos com sucesso, aguarde validação dos dados!");
                $this->router->redirect("app.motorista");
            }else{
                flash("danger", "{$this->user->nome}, ocorreu um problema, tente novamente!");
                $this->router->redirect("app.motorista");
            }
        }

        $head = $this->seo->optimize(
            "Motoristas",
            site("desc"),
            $this->router->route("app.meusdados"),
            routeImage("meusdados")
        )->render();

        $mot = new Motorista();
        $motorista = $mot->find("login_id = :login_id", "login_id={$_SESSION["user"]}")->fetch(true);
        if ($motorista){
            foreach ($motorista as $moto){
                $userc = new \stdClass();
                $userc->tipo_cnh = $moto->tipo_cnh;
                $userc->cnh = $moto->cnh;
                $userc->foto = $moto->foto;
            }
        }else{
            $userc = new \stdClass();
            $userc->tipo_cnh = null;
            $userc->cnh = null;
            $userc->foto = null;
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
     *
     */
    public function rota():void
    {
        $head = $this->seo->optimize(
            "Bem vindo(a)",
            site("desc"),
            $this->router->route("app.iniciocliente"),
            routeImage("Cliente")
        )->render();

        echo $this->view->render("theme/rotas/novarota",[
            "head" => $head,
            "user" => $this->user,
        ]);

    }

    public function contratarota(?array $data)
    {//valor	date	rota_id

        $head = $this->seo->optimize(
            "Bem vindo(a)",
            site("desc"),
            $this->router->route("app.iniciocliente"),
            routeImage("Cliente")
        )->render();


        echo $this->view->render("theme/rotas/contratarota",[
            "head" => $head,
            "user" => $this->user,
            "rota" => (new NovaRota())->findById($data["id"])
        ]);
    }

    public function venda(array $data)
    {
    if ($data["id"]){
        $valida = (new ContrataRota())->find("status = :status", "status=A")->fetch(true);
        if ($valida){
            flash("success", "vc tem uma rota em andamento!");
          
        }else{
            $venda = new ContrataRota();
            $venda->date = date("Y-m-d");
            $venda->status = "A";
            $venda->rota_id = $data["id"];
            $venda->login_id = $_SESSION["user"];
            $venda->save();
        }

    }
        $head = $this->seo->optimize(
            "Bem vindo(a)",
            site("desc"),
            $this->router->route("app.iniciocliente"),
            routeImage("Cliente")
        )->render();

        echo $this->view->render("theme/rotas/contratarota",[
            "head" => $head,
            "user" => $this->user,
            "rotas" => (new ContrataRota())->find("status = :status", "status=A")->fetch(true)
        ]);
    }

    /**
     *
     */
    public function rotasdisponiveis():void
    {
        $head = $this->seo->optimize(
            "Bem vindo(a)",
            site("desc"),
            $this->router->route("app.iniciocliente"),
            routeImage("Cliente")
        )->render();



        echo $this->view->render("theme/rotas/suasrotas",[
            "head" => $head,
            "user" => $this->user
        ]);

    }


    /**
     * @param $data
     * @throws \Exception
     */
    public function novarota($data):void
    {//id	quantidade	valor	cep_inicio	cep_fim	data_inicio	cidade_inicio	cidade_fim	tamahno	motorista_id

        if (!empty($data)) {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
            if (in_array("", $data)) {
                echo $this->ajaxResponse("message",[
                    "type" => "error",
                    "message" => "informe todos os campos!"
                ]);
                return;
            }

            $dt_atual = date("Y-m-d");
            if ($data["data_inicio"] < $dt_atual){
                echo $this->ajaxResponse("message",[
                    "type" => "error",
                    "message" => "A data inicio não pode ser menor que a data atual!"
                ]);
                return;
            }

            if ($data["data_inicio"] > $data["data_fim"]){
                echo $this->ajaxResponse("message",[
                    "type" => "error",
                    "message" => "A data fim não pode ser maior que a data inicio!"
                ]);
                return;
            }

            $id = (new Motorista())->find("", "login_id={$_SESSION["user"]}")->fetch(true);
            foreach ($id as $item){
                $ativo = ($item->ativo);
            }

            if ($ativo === "S"){
            $data_end = strtotime($data["data_fim"]);
            $data_dia = strtotime('+1 day', $data_end);
            $data_fim = date('Y-m-d', $data_dia);
            $start = new \DateTime($data["data_inicio"]);
            $end = new \DateTime($data_fim);
            $periodd = new \DatePeriod($start , new \DateInterval('P1D') , $end);

            $qtd = $data["quantidade"];
            $valor= $data["valor"];
            $cep_inicio = $data["cep_inicio"];
            $cep_fim = $data["cep_fim"];
            $cidade_inicio = $data["cidade_inicio"];
            $cidade_fim = $data["cidade_fim"];
            $tamanho = $data["tamanho"];

            foreach($periodd as $period) {
                $rota = new NovaRota();
                $data = $period->format('Y/m/d');
                $rota->quantidade = $qtd;
                $rota->valor = $valor;
                $rota->cep_inicio = $cep_inicio;
                $rota->cep_fim = $cep_fim;
                $rota->data_inicio = $data;
                $rota->cidade_inicio = $cidade_inicio;
                $rota->cidade_fim = $cidade_fim;
                $rota->tamanho = $tamanho;
                $rota->login_id = $_SESSION["user"];
                $rota->save();
            }
                if ($rota->save()){
                    echo $this->ajaxResponse("message",[
                        "type" => "success",
                        "message" => "Deu certo!"
                    ]);
                    return;
                }else{
                    echo $this->ajaxResponse("message",[
                        "type" => "danger",
                        "message" => "Deu ruim!"
                    ]);
                    return;
                }
            }else{
                echo $this->ajaxResponse("message",[
                    "type" => "alert",
                    "message" => "{$this->user->nome}, você ainda não esta ativado como motorista!"
                ]);
                return;
            }
        }

        $head = $this->seo->optimize(
            "Bem vindo(a)",
            site("desc"),
            $this->router->route("app.iniciocliente"),
            routeImage("Cliente")
        )->render();

        echo $this->view->render("theme/rotas/novarota",[
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

        $end = new Endereco();
        $endereco = $end->find("login_id = :login_id", "login_id={$_SESSION["user"]}")->fetch(true);
        if ($endereco){
            foreach ($endereco as $item){
                $end = new \stdClass();
                $end->cep = $item->cep;
                $end->rua = $item->rua;
                $end->complemento = $item->complemento;
                $end->bairro = $item->bairro;
                $end->numero = $item->numero;
                $end->cidade = $item->cidade;
                $end->estado = $item->estado;
            }
        }else{
            $end = new \stdClass();
            $end->cep = null;
            $end->rua = null;
            $end->complemento = null;
            $end->bairro = null;
            $end->numero = null;
            $end->cidade = null;
            $end->estado = null;
        }

        echo $this->view->render("theme/usuario/endereco",[
            "head" => $head,
            "user" => $this->user,
            "end" => $end
        ]);
    }

    /**
     *
     */
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

    /**
     * @param array $data
     */
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