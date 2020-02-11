<?php $v->layout("theme/usuario/meusdados"); ?>
<style>
    .maxSize {
        height: 90%;
        width: 90%;
    }
</style>

<div class="col-lg-8">
    <div class="main-content">
        <div class="single-content1">
            <div class="single-job mb-4 justify-content-between">
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
                                    <input type="text" class="form-control" value="<?= $userc->tipo_cnh; ?>" name="tipo_cnh">
                                </div>
                                <div class="form-group col-md-6">
                                    <span class="glyphicon glyphicon-text-width"></span> <label> Número CNH:</label>
                                    <input type="text" class="form-control" value="<?= $userc->cnh; ?>" name="cnh">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <span class="glyphicon glyphicon-pencil"></span> <label> Foto:</label>
                                    <input type="file" id="fileUpload" name="fileUpload" />
                                </div>
                                <?php if (!empty($userc->foto)): ?>
                                <div class="form-group col-md-4">
                                    <button style="margin-top: 25px" type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                       Ver foto
                                    </button>

                                </div>
                                <?php endif; ?>
                            </div>
                            <?php if (empty($userc)): ?>
                               <button type="submit" class="btn btn-success btn-lg btn-block active">Cadastrar</button>
                            <?php else: ?>
                                <button type="submit" class="btn btn-primary btn-lg btn-block active">Atualizar</button>
                            <?php endif; ?>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <h5 class="text-center">Clique na imagem para ampliar</h5>
                <img class="img-responsive" src="<?= asset("/../../../../".$userc->foto);?>">

        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('.img-responsive').on( "click", function() {
            $(this).toggleClass('maxSize')
        });
    });
</script>