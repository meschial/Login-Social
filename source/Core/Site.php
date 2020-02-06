<?php


namespace Source\Core;


use CoffeeCode\Optimizer\Optimizer;
use CoffeeCode\Router\Router;
use League\Plates\Engine;

class Site
{
    /** @var Engine */
    protected $view;

    /** @var Router */
    protected $router;

    /** @var Optimizer */
    protected $seo;

    /**
     * Controller constructor.
     * @param $router
     */
    public function __construct($router)
    {
        $this->router = $router;
        $this->view = Engine::create(dirname(__DIR__, 2) . "/views/site", "php");
        $this->view->addData(["router" => $this->router]);

        $this->seo = new Optimizer();
        $this->seo->openGraph(site("name"),site("locale"),"article")
            ->facebook(SOCIAL["facebook_appId"]);
    }

    /**
     * @param string $param
     * @param array $values
     * @return string
     */
    public function ajaxResponse(string $param, array $values): string
    {
        return \GuzzleHttp\json_encode([$param => $values]);
    }
}