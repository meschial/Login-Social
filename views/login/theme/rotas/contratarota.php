<?php $v->layout("theme/rotas/rotas"); ?>

<div class="col-lg-8">
    <div class="main-content">
        <div class="single-content1">
            <div class="single-job mb-4 justify-content-between">
                <div class="job-text">
                    <h1 style="color: #6c757d; text-align: center">Nova Rota</h1>
                    <ul class="mt-4">
                        <form class="auth_form" action="<?= $router->route("app.novarota") ?>" method="post" enctype="multipart/form-data">

                            <div class="login_form_callback">
                                <?= flash(); ?>
                            </div>

<?php var_dump($rotas); ?>
                            <?php foreach ($rotas as $venda): ?>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Id da venda:</label>
                                    <input type="text" class="form-control" value="<?= $venda->id; ?>" readonly  name="idvenda">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Data Inicio:</label>
                                    <input type="date" class="form-control" name="data_inicio">
                                </div>

                            </div>

                            <?php endforeach; ?>

                            <div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block active">Cadastrar</button>
                            </div>
                        </form>
                    </ul>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $v->start("scripts"); ?>
<script src="<?= asset("/../js/form.js"); ?>"></script>
<?php $v->end(); ?>