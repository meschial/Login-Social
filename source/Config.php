<?php

/*
 * SITE CONFIG
 */
define("SITE", [
    "name" => "TCC MeLeva",
    "desc" => "Envie suas encomendas com MeLeva",
    "locale" => "pt-BR",
    "root" => "https://localhost/tcc"
]);

/*
 * SITE MINIFY
 */
if ($_SERVER["SERVER_NAME"] == "localhost"){
    require __DIR__."/Minify.php";
}

/*
 * DB CONEXÃO
 */
define("DATA_LAYER_CONFIG", [
    "driver" => "mysql",
    "host" => "localhost",
    "port" => "3306",
    "dbname" => "tcc",
    "username" => "root",
    "passwd" => "",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
]);

/*
 * SOCIAL CONFIG
 */
define("SOCIAL", [
   "facebook_page" => "MarcosMuriloMeschial",
   "facebook_appId" => "MarcosMuriloMeschial"
]);

/*
 * E-MAIL CONEXAO
 */
define("MAIL",[
   "host" => "smtp.sendgrid.net",
   "port" => "587",
   "user" => "apikey",
   "passwd" => "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",
   "from_name" => "Marcos Murilo",
   "from_email" => "marcosmeschial@gmail.com"
]);

/*
 * FACEBOOK LOGIN
 */
define("FACEBOOK_LOGIN",[
    "clientId"          => "626209571533390",
    "clientSecret"      => "5a144630f596ae81d4c4c36ab62c7027",
    "redirectUri"       => SITE["root"]."/facebook",
    "graphApiVersion"   => "v6.0",
]);
/*
 * GOOGLE LOGIN
 */
define("GOOGLE_LOGIN",[
    "clientId"          => "19312449110-14s76g2qdregpckjgi7rg9dtrvcr1ak0.apps.googleusercontent.com",
    "clientSecret"      => "zttDV3C_PEHORWdR3Ogee0JY",
    "redirectUri"       => SITE["root"]."/google",
]);