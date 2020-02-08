<?php $v->layout("theme/theme"); ?>


<!-- Banner Area Starts -->
    <section class="banner-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 px-0">
                    <div class="banner-bg"></div>
                </div>
                <div class="col-lg-6 align-self-center">
                    <div class="banner-text">
                        <h1>envie rapido e fácil com a <span>me leva!</span></h1>
                        <p class="py-3">O Projeto ME LEVA se trata de um sistema de entrega de produtos, encomendas, cartas... É
                            um sistema de interface simples e de fácil acesso,
                            depois do cadastro aprovado qualquer pessoa pode levar ou enviar uma encomenda.
                            Basta fazer seu cadastro e achar o melhor preço</p>
                        <a href="<?= $router->route("web.cadastrar");?>" class="secondary-btn">cadastre-se<span class="flaticon-next"></span></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Area End -->

    <!-- Search Area Starts -->
    <div class="search-area">
        <div class="search-bg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <form action="#" class="d-md-flex justify-content-between">

                            <input type="text" placeholder="Search Keyword" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'" required>
                            <input type="text" placeholder="Search Keyword" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'" required>
                            <input type="text" placeholder="Search Keyword" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search Keyword'" required>
                            <button type="submit" class="template-btn">find job</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <!-- Search Area End -->
<div class="container" style="margin-top: 2%">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-top text-center">
                <h2>Veja alguns comentarios</h2>
                <p>Open lesser winged midst wherein may morning</p>
            </div>
        </div>
    </div>
<div style="margin-top: -5%">
    <div class="card-deck">
        <?php foreach($con as $tex): ?>
        <div class="card">
            <img src="<?= $tex->foto;?>" style="width: 80%; margin: 10%" class="card-img-top" alt="...">
            <div class="card-body">
                <h3 style="color: #4C5B5C"><?= $tex->titulo;?></h3>
                <p class="card-text"><?= $tex->texto; ?></p>
            </div>
            <div class="card-footer">
                <small class="text-muted"><?= $tex->nome; ?></small>
            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>
</div>
