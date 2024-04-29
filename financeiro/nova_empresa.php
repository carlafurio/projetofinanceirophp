<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/EmpresaDAO.php';
if(isset($_POST['btn-salvar'])){
    $nome = $_POST['nome'];
    $tel = $_POST['tel'];
    $endereco = $_POST['endereco'];

    $objDAO = new EmpresaDAO();
    $ret = $objDAO->cadastrarEmpresa($nome, $tel, $endereco);
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php'
?>
<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php'
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '_msg.php' ?>
                        <h2>Nova empresa</h2>
                        <h5>Cadastre uma nova empresa</h5>
                    </div>
                </div>
                <hr />
                <form action="nova_empresa.php" method="post">
                    <div id="divEMPRESA" class="form-group">
                        <label>Nome <em>(campo obrigatório)</em>:</label>
                        <input class="form-control" name="nome" placeholder="Ex.: BurgerKing" id="nomeempresa" maxlength="45"/>
                    </div>
                    <div id="divTELEFONE" class="form-group">
                        <label>Telefone:</label>
                        <input class="form-control" name="tel" placeholder="Ex.: +55449999-9999" id="telefone" maxlength="11"/>
                    </div>
                    <div id="divENDERECO" class="form-group">
                        <label>Endereço:</label>
                        <input class="form-control" name="endereco" placeholder="Ex.: Rua Brasil, Centro" id="endereco" maxlength="100"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btn-salvar" onclick="return validarEmpresa()">Salvar</button> 
                    <a href="cons_empresa.php" class="btn btn-info">Consultar empresas cadastradas</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>