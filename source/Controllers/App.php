<?php


namespace Source\Controllers;


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
    public function home()
    {
        $head = $this->seo->optimize(
            "Bem vindo(a) {$this->user->nome} | ". site("name"),
            site("desc"),
            $this->router->route("app.home"),
            routeImage("Conta de {$this->user->nome}"),
            )->render();
        echo $this->view->render("theme/dashboard",[
            "head" => $head,
            "user" => $this->user
        ]);
    }

    /**
     *
     */
    public function logoff(): void
    {
        unset($_SESSION["user"]);

        flash("info", "Você saiu com sucesso, volte logo {$this->user->nome}!");
        $this->router->redirect("web.login");

    }
}