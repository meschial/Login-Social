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
    h4{
        color: #4C5B5C;
    }
    .btn:hover {
        background: #5a5adb;
    }
    .btn-blue {
        background: #2e86de;
    }
</style>

        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h2 class="card-title text-center" style="color: #666966">Cadastro de Usuario</h2>
                            <form class="auth_form" action="<?= $router->route("auth.cadastrar"); ?>" method="post" enctype="multipart/form-data">

                                <div class="login_form_callback">
                                    <?= flash(); ?>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <span class="glyphicon glyphicon-user"></span> <label>Nome:</label>
                                        <input type="text" value="<?= $user->first_name; ?>"  class="form-control"  name="first_name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <span class="glyphicon glyphicon-star"></span> <label>Sobrenome:</label>
                                        <input type="text" value="<?= $user->last_name; ?>" class="form-control"  name="last_name">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <span class="glyphicon glyphicon-envelope"></span> <label>E-mail:</label>
                                        <input type="email" value="<?= $user->email; ?>" class="form-control"  name="email">
                                    </div>

                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <span class="glyphicon glyphicon-lock"></span> <label>Senha:</label>
                                        <input type="password" class="form-control"  name="passwd">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <span class="glyphicon glyphicon-lock"></span> <label>Repita a Senha:</label>
                                        <input type="password" class="form-control" >
                                    </div>
                                </div>
                                <button class="btn btn-block text-uppercase">Cadastrar</button>
                            </form>
                            <div class="form_register_action">
                                <h4>Já tem conta?</h4>
                                <a href="<?= $router->route("web.login"); ?>" class="btn btn-blue">Fazer Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
