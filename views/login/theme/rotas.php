<?php $v->layout("theme/theme"); ?>

<!-- Job Single Content Starts -->
<section class="job-single-content section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="jobs-tab tab-item">
                    <ul>
                        <li class="active">recent</li>
                        <li>full time</li>
                        <li>part time</li>
                        <li>intern</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="main-content">
                    <div class="single-content1">
                      <?php foreach ($rotas as $rota): ?>
                        <div class="single-job mb-4 d-lg-flex justify-content-between">
                            <div class="job-text">
                                <h4><b>CEP ORIGEM: <?= $rota->cep_inicio." <strong> / CEP DESTINO: </strong> ".$rota->cep_fim?></b></h4>
                                <ul class="mt-4">
                                    <li class="mb-3"><h5><i class="fa fa-map-marker"></i>Cidade Origem: <?= $rota->cidade_inicio?> / Destino: <?= $rota->cidade_fim?></h5></li>
                                    <li class="mb-3"><h5><i class="fa fa-pie-chart"></i>Qtd. de Pacotes: <?= $rota->quantidade;?> / Valor por pacote R$: <?= $rota->valor;?></h5></li>
                                    <li><h5><i class="fa fa-clock-o"></i> Data: <?= $rota->data_inicio; ?></h5></li>
                                </ul>
                            </div>
                            <div class="job-btn align-self-center">
                                <a href="#" class="forth-btn">Contratar</a>
                            </div>
                        </div>
                        <?php endforeach; ?>

                    </div>
                </div>
                <div class="more-job-btn mt-5 text-center">
                    <a href="#" class="template-btn">more job post</a>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sidebar mt-5 mt-lg-0">
                    <div class="single-item mb-4">
                        <h4 class="mb-4">jobs type</h4>
                        <a href="#" class="sidebar-btn d-flex justify-content-between mb-3">
                            <span>Full Time</span>
                            <span class="text-right">25 job</span>
                        </a>
                        <a href="#" class="sidebar-btn d-flex justify-content-between mb-3">
                            <span>Part Time</span>
                            <span class="text-right">25 job</span>
                        </a>
                        <a href="#" class="sidebar-btn d-flex justify-content-between">
                            <span>Internship</span>
                            <span class="text-right">25 job</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Job Single Content End -->