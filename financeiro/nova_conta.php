<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/ContaDAO.php';
if (isset($_POST['btn-salvar'])) {
    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $conta = $_POST['conta'];
    $saldo = $_POST['saldo'];
    $objDAO = new ContaDAO();

    $ret = $objDAO->cadastrarConta($banco, $agencia, $conta, $saldo);
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Nova conta</h2>
                        <h5>Cadastre uma nova conta</h5>
                    </div>
                </div>
                <hr/>
                <form action="nova_conta.php" method="post">
                    <div id="divBANCO" class="form-group">
                        <label>Banco <em>(campo obrigatório)</em>:</label>
                        <input name="banco" class="form-control" placeholder="Ex.: Sicredi" id="banco" maxlength="45"/>
                    </div>
                    <div id="divCONTA" class="form-group">
                        <label>Conta <em>(campo obrigatório)</em>:</label>
                        <input name="conta" class="form-control" placeholder="Ex.: 1234-5"  id="conta" maxlength="12"/>
                    </div>
                    <div id="divAGENCIA" class="form-group">
                        <label>Agência <em>(campo obrigatório)</em>:</label>
                        <input name="agencia" class="form-control" placeholder="Ex.: 1234" id="agencia" maxlength="6"/>
                    </div>
                    <div class="form-group">
                        <label>Saldo <em>(campo obrigatório)</em>:</label>
                        <div id="divSALDO" class="form-group input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="saldo" class="form-control" id="saldo">
                            
                        </div>
                    </div>
                    <button name="btn-salvar" onclick="return validarConta()" class="btn btn-success">Salvar</button>
                    <a href="cons_conta.php" class="btn btn-info">Consultar suas contas</a>
                </form>
                
            </div>
        </div>
    </div>
</body>

</html>