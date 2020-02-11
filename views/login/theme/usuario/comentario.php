<?php $v->layout("theme/usuario/meusdados"); ?>
<div class="col-lg-8">
    <div class="main-content">
        <div class="single-content1">
            <div class="single-job mb-4 justify-content-between">
                <div class="job-text">
                    <h3 style="color: #6c757d; text-align: center">Deixe um comentário sobre a MeLeva : )</h3>
                    <ul class="mt-4">
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
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="texto" rows="5" maxlength="200"></textarea>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg btn-block active">Enviar</button>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $v->start("scripts"); ?>
    <script src="<?= asset("/js/form.js"); ?>"></script>
<?php $v->end(); ?>