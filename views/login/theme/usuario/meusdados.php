<?php $v->layout("theme/theme"); ?>
<div class="container">
    <div class="row">
        <div class="form-group col-md-6" >
            <div class="text-center">
                <h1 style="color: #6c757d">Cadastro de Cliente</h1>
            </div>
            <form class="auth_form" action="<?= $router->route("app.home"); ?>" method="post" enctype="multipart/form-data">

                <div class="login_form_callback">
                    <?= flash(); ?>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="glyphicon glyphicon-list-alt"></span> <label> CPF:</label>
                        <input type="text" value="<?= $userc->cpf ?>" class="form-control" name="cpf">
                    </div>
                    <div class="form-group col-md-6">
                        <span class="glyphicon glyphicon-list-alt"></span> <label> RG:</label>
                        <input type="text" value="<?= $userc->rg; ?>" class="form-control" name="rg">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <span class="glyphicon glyphicon-calendar"></span> <label>Data Nascimento:</label>
                        <input type="date"  value="<?= $userc->date; ?>" class="form-control"  name="date">
                    </div>
                    <div class="form-group col-md-6">
                        <span class="glyphicon glyphicon-earphone"> </span> <label>N. Celular:</label>
                        <input type="text" value="<?= $userc->celular; ?>" class="form-control" name="celular">
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-success">Cadastrar</button>
            </form>
        </div>
    </div>
</div>