<?php
require_once '../DAO/UtilDAO.php';


?>
<nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="inicial.php" > <img style="max-width: 40px;  " src="../financeiro/assets/img/logosimples.png" alt="LOGO" title="LOGO"> CF TECH - Controle Financeiro</a>
    </div>
    <div style="color: white;
                padding: 15px 50px 5px 50px;
                float: right;
                font-size: 12px;">Olá, <?=UtilDAO::nomeLogado()?> | Suporte: (44) 99969-6011 - Seg. a Sex. 08h às 17h </div>
</nav>