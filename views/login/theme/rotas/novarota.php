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
                                    <input type="text" id="cep" class="form-control" data-mask="99999-999" name="cep_inicio">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Cep Destino:</label>
                                    <input type="text" id="cep2" class="form-control" data-mask="99999-999" name="cep_fim">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Valor Un:</label>
                                    <input type="text" class="form-control" name="valor">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Cidade Origem:</label>
                                    <input type="text" id="cidade" readonly class="form-control" name="cidade_inicio">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Cidade Destino:</label>
                                    <input type="text" id="cidade2" readonly class="form-control" name="cidade_fim">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Quantidade:</label>
                                    <input type="text" class="form-control" name="quantidade">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label>Data Inicio:</label>
                                    <input type="date" class="form-control" name="data_inicio">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Data Fim:</label>
                                    <input type="date" class="form-control" name="data_fim">
                                </div>
                                <div class="form-group col-md-4">
                                    <label>Tamanho:</label>
                                    <input type="text" class="form-control" name="tamanho">
                                </div>
                            </div>

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
<script src="<?= asset("/js/form.js"); ?>"></script>
<?php $v->end(); ?>

<!-- Adicionando JQuery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

<!-- Adicionando Javascript -->
<script type="text/javascript" >

    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#cidade").val("");
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
                   $("#cidade").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                           $("#cidade").val(dados.localidade);
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

<!-- Adicionando Javascript -->
<script type="text/javascript" >

    $(document).ready(function() {

        function limpa_formulário_cep() {
            // Limpa valores do formulário de cep.
            $("#cidade2").val("");
        }

        //Quando o campo cep perde o foco.
        $("#cep2").blur(function() {

            //Nova variável "cep" somente com dígitos.
            var cep2 = $(this).val().replace(/\D/g, '');

            //Verifica se campo cep possui valor informado.
            if (cep2 != "") {

                //Expressão regular para validar o CEP.
                var validacep2 = /^[0-9]{8}$/;

                //Valida o formato do CEP.
                if(validacep2.test(cep2)) {

                    //Preenche os campos com "..." enquanto consulta webservice.
                    $("#cidade2").val("...");

                    //Consulta o webservice viacep.com.br/
                    $.getJSON("https://viacep.com.br/ws/"+ cep2 +"/json/?callback=?", function(dados) {

                        if (!("erro" in dados)) {
                            //Atualiza os campos com os valores da consulta.
                            $("#cidade2").val(dados.localidade);
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
