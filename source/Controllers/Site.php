<?php


namespace Source\Controllers;


use Source\Core\Controller;
use Source\Models\Comentario;
use Source\Models\Faq\Cliente;
use Source\Models\User;

class Site extends Controller
{
    protected $user;
    public function __construct($router)
    {
        parent::__construct($router);

        if (empty($_SESSION["user"]) || !$this->user = (new User())->findById($_SESSION["user"])){

        }
    }


    public function inicio()
    {
        $head = $this->seo->optimize(
            "Bem vindo ao".site("name"),
            site("desc"),
            $this->router->route("site.inicio"),
            routeImage("Inicio")
        )->render();

        echo $this->view->render("theme/inicio",[
           "head" => $head,
            "user" =>$this->user,
            "con" => (new Comentario())
            ->find("","","titulo, texto, nome, foto")
            ->order("RAND()")
            ->limit(3)
            ->fetch(true)
        ]);
    }
    public function teste()
    {
        $head = $this->seo->optimize(
            "Bem vindo ao".site("name"),
            site("desc"),
            $this->router->route("site.teste"),
            routeImage("Inicio")
        )->render();

        echo $this->view->render("theme/teste",[
            "head" => $head,
            "user" =>$this->user
        ]);
    }
}