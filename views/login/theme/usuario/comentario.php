<?php $v->layout("theme/theme"); ?>
<div class="container">
    <div class="row">
        <div class="form-group col-md-6" >
            <div class="text-center">
                <h1 style="color: #6c757d">Cadastro de Cliente</h1>
            </div>
            <form class="auth_form" action="<?= $router->route("app.comentario"); ?>" method="post" enctype="multipart/form-data">

                <div class="login_form_callback">
                    <?= flash(); ?>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-12">
                        <span class="glyphicon glyphicon-text-width"></span> <label>  Titulo:</label>
                        <input type="text" class="form-control" name="titulo">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <span class="glyphicon glyphicon-pencil"></span> <label> Menssagem:</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="texto" rows="3" maxlength="200"></textarea>
                    </div>

                </div>

                <button type="submit" class="btn btn-outline-success">Cadastrar</button>
            </form>
        </div>
    </div>
</div>
