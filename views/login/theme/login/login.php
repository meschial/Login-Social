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
        background: #2758b0;
        color: #ffffff;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        border-radius: 5px;
        text-shadow: 1px 1px 0 rgba(0, 0, 0, 0.3);
        transition-duration: 0.3s;
    }
    .btn:hover {
        background: #5a5adb;
    }
    .btn-blue {
        background: #2e86de;
    }

    .btn-blue:hover {
        background: #54a0ff;
    }

    .btn-facebook {
        background: #3C5D96;
    }

    .btn-facebook:hover {
        background: #4b74b7;
    }

    .btn-google {
        background: #D05C45;
    }

    .btn-google:hover {
        background: #ef6951;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h2 class="card-title text-center" style="color: #666966">Fazer Login</h2>
                    <form class="auth_form" action="<?= $router->route("auth.login"); ?>" method="post" enctype="multipart/form-data">
                        <div class="form_social">
                            <a href="<?= $router->route("auth.facebook"); ?>" class="btn btn-facebook">Facebook Login</a>
                            <a href="<?= $router->route("auth.google"); ?>" class="btn btn-google">Google Login</a>
                        </div>

                        <div class="login_form_callback">
                            <?= flash(); ?>
                        </div>

                        <div class="form-label-group">
                            <ion-icon name="airplane"></ion-icon>
                            <span class="glyphicon glyphicon-envelope"></span> <label for="inputEmail">Email:</label>
                            <input type="email" name="email" class="form-control"  placeholder="E-mail">
                        </div><br>

                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <span class="glyphicon glyphicon-lock"></span> <label>Senha:</label>
                                <input type="password" name="passwd" class="form-control"  placeholder="Password">
                            </div>
                        </div>

                        <button class="btn btn-block text-uppercase">Entrar</button>

                        <small class="form-text text-muted">Esqueceu a senha? <a href="<?= $router->route("web.forget"); ?>">Clique aqui</a>.</small>

                        <div class="form_register_action">
                            <h5>Ainda não tem conta?</h5>
                            <a href="<?= $router->route("web.cadastrar"); ?>" class="btn btn-blue">Cadastre-se Aqui</a>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

