<?php $v->layout("theme/_theme"); ?>

<div class="page">
    <?php if ($user->foto): ?>
        <img class="page_user_photo" src="<?= $user->foto; ?>" alt="<?= $user->nome; ?>" title="<?= $user->nome; ?>"/>
    <?php endif; ?>
    <h1>Olá <?= $user->nome; ?>,</h1>
    <p>Aqui é sua conta no projeto, mas por enquanto a única coisa que você pode fazer é sair dela :P</p>
    <a href="<?= $router->route("app.teste"); ?>" class="btn btn-blue">Cadastre-se Aqui</a>
    <p><a class="btn btn-green" href="<?= $router->route("app.logoff"); ?>" title="Sair agora">SAIR AGORA :)</a></p>
</div>
