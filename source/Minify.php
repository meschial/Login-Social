<?php
/*
 * CSS
 */
$minCSS = new \MatthiasMullie\Minify\CSS();
$minCSS->add(dirname(__DIR__, 1)."/views/login/assets/css/style.css");
$minCSS->add(dirname(__DIR__, 1)."/views/login/assets/css/form.css");
$minCSS->add(dirname(__DIR__, 1)."/views/login/assets/css/button.css");
$minCSS->add(dirname(__DIR__, 1)."/views/login/assets/css/message.css");
$minCSS->add(dirname(__DIR__, 1)."/views/login/assets/css/load.css");
$minCSS->minify(dirname(__DIR__, 1)."/views/login/assets/style.min.css");

/*
 * JS
 */

$minJS = new \MatthiasMullie\Minify\JS();
$minJS->add(dirname(__DIR__, 1)."/views/login/assets/js/jquery.js");
$minJS->add(dirname(__DIR__, 1)."/views/login/assets/js/jquery-ui.js");
$minJS->minify(dirname(__DIR__, 1) ."/views/login/assets/scripts.min.js");