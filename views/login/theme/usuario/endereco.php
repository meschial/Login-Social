<?php $v->layout("theme/theme"); ?>

<div class="container">
    <div class="row">
        <div class="form-group col-md-6" >
            <div class="text-center">
                <h1 style="color: #6c757d">Cadastro de Rotas</h1>
            </div>
            <form class="auth_form" action="<?= $router->route("app.endereco") ?>" method="post" enctype="multipart/form-data">

                <div class="login_form_callback">
                    <?= flash(); ?>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label>Cep:</label>
                        <input type="text" class="form-control" placeholder="Digite seu cep" name="cep">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Rua:</label>
                        <input type="text" class="form-control" placeholder="Digite o nome da rua"  name="rua">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Complemento:</label>
                        <input type="text" class="form-control" placeholder="Digite o complemento" name="complemento">
                    </div>

                </div>

                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label>Bairro:</label>
                        <input type="text" class="form-control" name="bairro">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Cidade:</label>
                        <input type="text" class="form-control" name="cidade">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Estado:</label>
                        <input type="text" class="form-control" placeholder="Digite o númeor"  name="estado">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Número:</label>
                        <input type="text" class="form-control" placeholder="Digite o númeor"  name="numero">
                    </div>
                </div>

                <button type="submit" class="btn btn-outline-success">Cadastrar</button>
            </form>
        </div><br>
        <div class="form-group col-md-6" >
            <div class="text-center">
                <h1 style="color: #6c757d">Plano escolhido</h1>
            </div>

            <div class="">
                <div class="single-table text-center mb-4 mb-md-0">
                    <div class="table-top">
                        <h3>Cliente</h3>
                        <i class="fa fa-home"></i>
                    </div>
                    <ul class="my-5">
                        <li class="mb-2">Pesquisar Rotas</li>
                        <li class="mb-2">Contato com o motorista</li>
                        <li class="mb-2">Pagamentos faceis</li>
                        <li class="mb-2">Suporte 24Hrs</li>
                        <li class="mb-2">Historicos de rotas</li>
                        <li>Crie sua conta sem custo!!</li>
                    </ul>

                </div>
            </div>

        </div><br>
    </div>
</div>