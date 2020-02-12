<?php $v->layout("theme/rotas/rotas"); ?>

<div class="col-lg-8">
    <div class="main-content">
        <div class="single-content1">
            <div class="single-job mb-4 justify-content-between">
                <div class="job-text">
                    <h1 style="color: #6c757d; text-align: center">Rotas em andamento</h1>
                    <ul class="mt-4">
                        <div class="accordion" id="accordionExample">

                            <?php foreach ($dados as $rota): ?>
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                            Rota De <?= $rota->cidade_inicio;?> Para <?= $rota->cidade_fim;?> / No Dia: <?= $rota->data_inicio;?>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <p>Olá <?= $user->nome;?> no dia <strong><?= $rota->data_inicio;?></strong> você tem a rota de, <strong><?= $rota->cidade_inicio;?></strong>
                                            X <strong><?= $rota->cidade_fim;?></strong> Iniciando pelo CEP:<strong><?= $rota->cep_inicio;?></strong> para o CEP:
                                            <strong><?= $rota->cep_fim;?></strong>, levando um total de <strong><?= $rota->quantidade;?></strong> pacotes, cobrando um valor de
                                            <strong>R$<?= $rota->valor;?></strong> por pacote para fazer a entrega.
                                        </p>
                                     </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </ul>
                </div>
                <div>
                </div>
            </div>
        </div>
    </div>
</div>