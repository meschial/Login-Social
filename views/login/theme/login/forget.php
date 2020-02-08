<?php $v->layout("theme/theme"); ?>
<style>
    .btn {
        display: inline-block;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        border: none;
        font-size: 0.9em;
        font-weight: bold;
        padding: 8px 16px;
        background: #333333;
        color: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.3);
        transition-duration: 0.3s;
    }
    h4{
        color: #ffffff;
    }
    .btn-blue {
        background: #2e86de;
    }

    .btn-blue:hover {
        background: #54a0ff;
    }

</style>
<!-- Newsletter Area Starts -->
<section class="newsletter-area section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-top text-center">
                    <h2>Esqueceu sua senha, então vamos recuperar!</h2>
                    <p>Informe seu e-mail para receber um link de recuperação!</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <form class="auth_form" data-reset="true" action="<?= $router->route("auth.forget"); ?>" method="post" enctype="multipart/form-data">
                    <div class="login_form_callback">
                        <?= flash(); ?>
                    </div>



                    <input type="email" name="email" class="form-control"  placeholder="Digite seu E-mail para recuperar">
                    <button type="submit" class="template-btn">Recuperar</button>
                </form>
                <div class="form_register_action">
                    <h4>Você também pode:</h4>
                    <a href="<?= $router->route("web.login"); ?>" class="btn btn-blue">Voltar ao Login</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Newsletter Area End -->