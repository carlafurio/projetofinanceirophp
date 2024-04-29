<?php 
require_once '../DAO/UtilDAO.php';
if(isset($_GET['close']) && $_GET['close'] == '1'){
    UtilDAO::deslogarUsuario();
}

?>
<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li class="text-center">
                <img src="assets/img/find_user.png" class="user-image img-responsive" />
            </li>


            <li>
                <a href="meus_dados.php"><i class="fa fa-user fa-3x"></i> Meus Dados</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-3x"></i> Categoria<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_categoria.php">Nova Categoria</a>
                    </li>
                    <li>
                        <a href="cons_categoria.php">Consultar Categoria</a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-3x"></i> Empresas<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_empresa.php">Nova Empresa</a>
                    </li>
                    <li>
                        <a href="cons_empresa.php">Consultar Empresas</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-3x"></i> Contas<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_conta.php">Nova Conta</a>
                    </li>
                    <li>
                        <a href="cons_conta.php">Consultar Contas</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap fa-3x"></i>Movimentos<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="realizar_movimento.php">Realizar Movimento</a>
                    </li>
                    <li>
                        <a href="cons_movimento.php">Consultar Movimento</a>
                    </li>
                </ul>
            </li>
            <li>
                <a href="_menu.php?close=1"><i class="fa fa-square-o fa-3x"></i> Sair</a>
            </li>

        </ul>

    </div>

</nav>