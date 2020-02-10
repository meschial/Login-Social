<?php $v->layout("theme/usuario/meusdados"); ?>

<div class="col-lg-8">
    <div class="main-content">
        <div class="single-content1">
            <div class="single-job mb-4 d-lg-flex justify-content-between">
                <div class="job-text">
                    <h3 style="color: #6c757d; text-align: center">Deixe um comentário sobre a MeLeva : )</h3>
                    <ul class="mt-4">
                        <form action="<?= $router->route("app.motorista"); ?>" method="post" enctype="multipart/form-data">

                            <div class="login_form_callback">
                                <?= flash(); ?>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <span class="glyphicon glyphicon-text-width"></span> <label>  Tipo CNH:</label>
                                    <input type="text" class="form-control" name="tipo_cnh">
                                </div>
                                <div class="form-group col-md-6">
                                    <span class="glyphicon glyphicon-text-width"></span> <label> Número CNH:</label>
                                    <input type="text" class="form-control" name="cnh">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <span class="glyphicon glyphicon-pencil"></span> <label> Foto:</label>
                                    <input type="file" id="fileUpload" name="fileUpload" />
                                </div>
                            </div>
                            <div class="job-btn align-self-center">
                                <button type="submit" class="btn btn-outline-success">Enviar</button>
                            </div>
                        </form>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</div>