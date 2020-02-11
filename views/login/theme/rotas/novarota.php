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

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Cep Origem:</label>
                                    <input type="text" class="form-control" data-mask="99999-999" name="cep_inicio">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Cep Destino:</label>
                                    <input type="text" class="form-control" data-mask="99999-999" name="cep_fim">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Valor Un:</label>
                                    <input type="text" class="form-control" name="valor">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Data:</label>
                                    <input type="date" class="form-control" name="data_inicio">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Cidade Origem:</label>
                                    <input type="text" class="form-control" name="cidade_inicio">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Cidade Destino:</label>
                                    <input type="text" class="form-control" name="cidade_fim">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Quantidade:</label>
                                    <input type="text" class="form-control" name="quantidade">
                                </div>
                                <div class="form-group col-md-2">
                                    <label>Tamanho:</label>
                                    <input type="text" class="form-control" name="tamanho">
                                </div>
                            </div>

                            <div>
                                <?php if (empty($end)): ?>
                                    <button type="submit" class="btn btn-success btn-lg btn-block active">Cadastrar</button>
                                <?php else: ?>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block active">Atualizar</button>
                                <?php endif; ?>
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
<script src="<?= asset("/js/form.js"); ?>"></script>
<?php $v->end(); ?>

