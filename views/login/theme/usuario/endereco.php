        <?php $v->layout("theme/usuario/meusdados"); ?>

        <div class="col-lg-8">
            <div class="main-content">
                <div class="single-content1">
                    <div class="single-job mb-4 justify-content-between">
                        <div class="job-text">
                            <h1 style="color: #6c757d; text-align: center">Meu Endereço</h1>
                            <ul class="mt-4">
                                <form class="auth_form" action="<?= $router->route("app.endereco") ?>" method="post" enctype="multipart/form-data">

                                    <div class="login_form_callback">
                                        <?= flash(); ?>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Cep:</label>
                                            <input type="text" class="form-control" data-mask="99999-999" value="<?= $end->cep; ?>" id="cep" placeholder="Digite seu cep" name="cep">
                                        </div>
                                        <div class="form-group col-md-8">
                                            <label>Rua:</label>
                                            <input type="text" class="form-control" id="rua" value="<?= $end->rua; ?>" placeholder="Digite o nome da rua"  name="rua">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Complemento:</label>
                                            <input type="text" class="form-control" value="<?= $end->complemento; ?>" placeholder="Digite o complemento" name="complemento">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-9">
                                            <label>Bairro:</label>
                                            <input type="text" id="bairro" class="form-control" value="<?= $end->bairro; ?>" placeholder="Digite seu bairro" name="bairro">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Número:</label>
                                            <input type="text" class="form-control" value="<?= $end->numero; ?>" placeholder="Digite o número"  name="numero">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Cidade:</label>
                                            <input type="text" id="cidade" name="cidade" Readonly  class="form-control" value="<?= $end->cidade; ?>" placeholder="Digite o cep correto">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Estado:</label>
                                            <input type="text" id="uf" name="estado" Readonly class="form-control" value="<?= $end->estado; ?>" placeholder="Digite o cep correto">
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
        <script>
            src="<?= asset("/js/form.js"); ?>">
        </script>

            <!-- Adicionando JQuery -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"
                    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
                    crossorigin="anonymous"></script>

            <!-- Adicionando Javascript -->
            <script type="text/javascript" >

                $(document).ready(function() {

                    function limpa_formulário_cep() {
                        // Limpa valores do formulário de cep.
                        $("#rua").val("");
                        $("#bairro").val("");
                        $("#cidade").val("");
                        $("#uf").val("");
                    }

                    //Quando o campo cep perde o foco.
                    $("#cep").blur(function() {

                        //Nova variável "cep" somente com dígitos.
                        var cep = $(this).val().replace(/\D/g, '');

                        //Verifica se campo cep possui valor informado.
                        if (cep != "") {

                            //Expressão regular para validar o CEP.
                            var validacep = /^[0-9]{8}$/;

                            //Valida o formato do CEP.
                            if(validacep.test(cep)) {

                                //Preenche os campos com "..." enquanto consulta webservice.
                                $("#rua").val("...");
                                $("#bairro").val("...");
                                $("#cidade").val("...");
                                $("#uf").val("...");

                                //Consulta o webservice viacep.com.br/
                                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                                    if (!("erro" in dados)) {
                                        //Atualiza os campos com os valores da consulta.
                                        $("#rua").val(dados.logradouro);
                                        $("#bairro").val(dados.bairro);
                                        $("#cidade").val(dados.localidade);
                                        $("#uf").val(dados.uf);
                                    } //end if.
                                    else {
                                        //CEP pesquisado não foi encontrado.
                                        limpa_formulário_cep();
                                        alert("CEP não encontrado.");
                                    }
                                });
                            } //end if.
                            else {
                                //cep é inválido.
                                limpa_formulário_cep();
                                alert("Formato de CEP inválido.");
                            }
                        } //end if.
                        else {
                            //cep sem valor, limpa formulário.
                            limpa_formulário_cep();
                        }
                    });
                });

            </script>
