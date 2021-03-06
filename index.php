<?php
ob_start();
session_start();

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(site());

$router->namespace("Source\Controllers");
/*
 * SITE ABERTO
 */
$router->group(null);
$router->get("/", "Site:inicio", "site.inicio");
$router->get("/rotas", "Site:rotas", "site.rotas");

/*
 * PROTEGIDOS GET
 */
$router->group("/me");
$router->get("/", "App:iniciocliente", "app.iniciocliente");
$router->get("/documentos", "App:home", "app.home");
$router->get("/endereco", "App:endereco", "app.endereco");
$router->get("/comentario", "App:comentario", "app.comentario");
$router->get("/cartao", "App:cartao", "app.cartao");
$router->get("/meusdados", "App:meusdados", "app.meusdados");
$router->get("/motorista", "App:motorista", "app.motorista");
$router->get("/rota", "App:rota", "app.rota");
$router->get("/novarota", "App:novarota", "app.novarota");
$router->get("/suasrotas", "App:suasrotas", "app.suasrotas");
$router->get("/contratarota/{id}", "App:contratarota", "app.contratarota");
$router->get("/listavenda", "App:listavenda", "app.listavenda");

$router->get("/sair", "App:logoff", "app.logoff");


/*
 * PROTEGIDOS POST
 */
$router->post("/documentos", "App:home", "app.home");
$router->post("/endereco", "App:endereco", "app.endereco");
$router->post("/comentario", "App:comentario", "app.comentario");
$router->post("/motorista", "App:motorista", "app.motorista");
$router->post("/novarota", "App:novarota", "app.novarota");
$router->post("/venda", "App:venda", "app.venda");
$router->post("/contratarota", "App:contratarota", "app.contratarota");

/*
 * GET LOGIN
 */
$router->group(null);
$router->get("/login", "Web:login", "web.login");
$router->get("/cadastrar", "Web:cadastrar", "web.cadastrar");
$router->get("/recuperar", "Web:forget", "web.forget");
$router->get("/senha/{email}/{forget}", "Web:reset", "web.reset");

/*
 * POST LOGIN
 */
$router->group(null);
$router->post("/login", "Auth:login", "auth.login");
$router->post("/cadastrar", "Auth:cadastrar", "auth.cadastrar");
$router->post("/forget", "Auth:forget", "auth.forget");
$router->post("/reset", "Auth:reset", "auth.reset");

/*
 * LOGIN SOCIAL
 */
$router->group(null);
$router->get("/facebook", "Auth:facebook", "auth.facebook");
$router->get("/google", "Auth:google", "auth.google");


/*
 * ROTA DE ERROR
 */
$router->group("ops");
$router->get("/{errcode}", "Web:error", "web.error");

/*
 * executa a rota
 */
$router->dispatch();

/*
 * PROCESSO DE ERROR
 */
if ($router->error()){
    $router->redirect("web.error", ["errcode" => $router->error()]);
}
ob_end_flush();