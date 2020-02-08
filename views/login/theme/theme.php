<?php

use Source\Models\Conta;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?= $head; ?>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= asset("/../estilo/favicon.png"); ?>" type="image/x-icon">
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?= asset("/../estilo/css/message.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/../estilo/css/form.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/../estilo/css/load.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/../estilo/css/icon.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/../estilo/fonts/flat-icon/flaticon.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/../estilo/css/bootstrap.min.css"); ?>">
    <link rel="stylesheet" href="<?= asset("/../estilo/css/style.css"); ?>">
</head>
<body>
<!-- Preloader Starts -->
<!-- Preloader End -->
<!-- Header Area Starts -->
<header class="header-area main-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="logo-area">
                    <a href=""><img src="<?= asset("/../estilo/images/logo.jpg"); ?>" alt="logo"></a>
                </div>
            </div>
            <div class="col-lg-10">
                <div class="custom-navbar">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="main-menu">
                    <ul>
                        <li class="active"><a href="<?= $router->route("site.inicio");?>">inicio</a></li>
                        <li><a href="">tamanho</a></li>
                        <li><a href="job-category.html">category</a></li>
                        <li><a href="#">blog</a>
                            <ul class="sub-menu">
                                <li><a href="blog-home.html">Blog Home</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                            </ul>
                        </li>
                        <li><a href="<?= $router->route("web.teste"); ?>">contato</a></li>
                        <li><a href="#">pages</a>
                            <ul class="sub-menu">
                                <li><a href="job-search.html">Job Search</a></li>
                                <li><a href="job-single.html">Job Single</a></li>
                                <li><a href="pricing-plan.html">Pricing Plan</a></li>
                                <li><a href="elements.html">Elements</a></li>
                            </ul>
                        </li>
                        <li class="menu-btn">
                            <?php if (empty($_SESSION["user"])): ?>
                            <a href="<?= $router->route("web.login"); ?>" class="login">Entrar</a>
                            <a href="<?= $router->route("web.cadastrar"); ?>" class="template-btn">cadastrar</a>
                            <?php else: ?>
                                <div class="btn-group" role="group">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" >
                                        <?php
                                        if (!empty($user->foto)): ?>
                                            <img src="<?= $user->foto; ?>" class="img-fluid img-thumbnail"style="width: 60px">
                                        <?php else: ?>
                                        Olá <?= $user->nome; ?>
                                        <?php endif; ?>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="<?= $router->route("app.home");?>">Meus Dados</a>
                                        <a class="dropdown-item" href="<?= $router->route("app.cartao");?>">Pag> Cartão</a>
                                        <a class="dropdown-item" href="<?= $router->route("app.endereco"); ?>">Endereço</a>
                                        <a class="dropdown-item" href="<?= $router->route("app.iniciocliente");?>">Resultados</a>
                                        <a class="dropdown-item" href="<?= $router->route("app.comentario");?>">Comentarios</a>
                                        <a class="dropdown-item" href="<?= $router->route("app.logoff"); ?>">sair</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Header Area End -->
<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <div class="ajax_load_box_title">Aguarde, carrengando...</div>
    </div>
</div>

<!--CONTENT-->
<main class="main_content">
    <?= $v->section("content"); ?>
</main>

<!-- Footer Area Starts -->
<footer class="footer-area section-padding" style="margin-top: 3%">
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-xl-2 col-lg-3">
                    <div class="single-widget-home mb-5 mb-lg-0">
                        <h3 class="mb-4">top products</h3>
                        <ul>
                            <li class="mb-2"><a href="#">managed website</a></li>
                            <li class="mb-2"><a href="#">managed reputation</a></li>
                            <li class="mb-2"><a href="#">power tools</a></li>
                            <li><a href="#">marketing service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-5 offset-xl-1 col-lg-6">
                    <div class="single-widget-home mb-5 mb-lg-0">
                        <h3 class="mb-4">newsletter</h3>
                        <p class="mb-4">You can trust us. we only send promo offers, not a single.</p>
                        <form action="#">
                            <input type="email" placeholder="Your email here" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Your email here'" required>
                            <button type="submit" class="template-btn">subscribe now</button>
                        </form>
                    </div>
                </div>
                <div class="col-xl-3 offset-xl-1 col-lg-3">
                    <div class="single-widge-home">
                        <h3 class="mb-4">instagram feed</h3>
                        <div class="feed">
                            <img src="<?= asset("/../estilo/images/feed1.jpg"); ?>" alt="feed">
                            <img src="<?= asset("/../estilo/images/feed2.jpg"); ?>" alt="feed">
                            <img src="<?= asset("/../estilo/images/feed3.jpg"); ?>" alt="feed">
                            <img src="<?= asset("/../estilo/images/feed4.jpg"); ?>" alt="feed">
                            <img src="<?= asset("/../estilo/images/feed5.jpg"); ?>" alt="feed">
                            <img src="<?= asset("/../estilo/images/feed6.jpg"); ?>" alt="feed">
                            <img src="<?= asset("/../estilo/images/feed7.jpg"); ?>" alt="feed">
                            <img src="<?= asset("/../estilo/images/feed8.jpg"); ?>" alt="feed">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                            <span><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
</span>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="social-icons">
                        <ul>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-behance"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Footer Area End -->

<!-- Javascript -->




<script src="<?= asset("/../estilo/js/jquery.js"); ?>"></script>
<script src="<?= asset("/../estilo/js/jquery-ui.js"); ?>"></script>
<script src="<?= asset("/../estilo/js/form.js"); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>



</body>
</html>
