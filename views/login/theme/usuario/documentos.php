<?php $v->layout("theme/usuario/meusdados"); ?>

<div class="col-lg-8">
    <div class="main-content">
        <div class="single-content1">
            <div class="single-job mb-4 justify-content-between">
                <div class="job-text">
                    <h1 style="color: #6c757d; text-align: center">Meus Documentos</h1>
                    <ul class="mt-4">
                        <form class="auth_form" action="<?= $router->route("app.home"); ?>" method="post" enctype="multipart/form-data">

                            <div class="login_form_callback">
                                <?= flash(); ?>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <span class="glyphicon glyphicon-list-alt"></span> <label> CPF:</label>
                                    <input type="text" value="<?= $userc->cpf ?>" data-mask="999.999.999-99" placeholder="Digite seu CPF" class="form-control" name="cpf">
                                </div>
                                <div class="form-group col-md-6">
                                    <span class="glyphicon glyphicon-list-alt"></span> <label> RG:</label>
                                    <input type="text" value="<?= $userc->rg; ?>" class="form-control" placeholder="Digite seu RG" name="rg">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <span class="glyphicon glyphicon-calendar"></span> <label>Data Nascimento:</label>
                                    <input type="date"  value="<?= $userc->date; ?>" class="form-control" placeholder="Data de nascimento"  name="date">
                                </div>
                                <div class="form-group col-md-6">
                                    <span class="glyphicon glyphicon-earphone"> </span> <label>N. Celular:</label>
                                    <input type="text" value="<?= $userc->celular; ?>" data-mask="(99)99999-9999" placeholder="Digite seu número" class="form-control" name="celular">
                                </div>
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

<?php $v->start("scripts"); ?>
<script src="<?= asset("/js/form.js"); ?>"></script>
<?php $v->end(); ?>
