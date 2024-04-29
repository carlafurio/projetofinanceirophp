<?php 
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/ContaDAO.php';
$dao = new ContaDAO();

if(isset($_GET['cod']) && is_numeric($_GET['cod'])){
    $idConta = $_GET['cod'];
    $dados = $dao->detalharConta($idConta);

    if(count($dados) == 0){
        header('location: cons_conta.php');
        exit;
    }

} else if(isset($_POST['btn-salvar'])){
    $idConta = $_POST['cod'];
    $banco = $_POST['banco'];
    $conta = $_POST['conta'];
    $agencia = $_POST['agencia'];
    $saldo = $_POST['saldo'];


    $ret = $dao->alterarConta($idConta, $banco, $conta, $agencia, $saldo);
    if($ret === 1){
        header('location: cons_conta.php?ret=1');
        exit;
    }
} else if(isset($_POST['btn-excluir'])){
    $idConta = $_POST['cod'];
    $ret = $dao->excluirConta($idConta);
    header('location: cons_conta.php?ret='.$ret);
    exit;
} else {
    header('location: cons_conta.php');
    exit;
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
                        <h2>Alterar conta</h2>
                        <h5>Altere os dados da conta</h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_conta.php" method="post">
                    <input type="hidden" name="cod" value="<?=$dados[0]['id_conta']?>">
                    <div id="divBANCO" class="form-group">
                        <label>Banco:</label>
                        <input class="form-control" value="<?=isset($dados[0]['nome_banco']) ? $dados[0]['nome_banco'] : ''?>" name="banco" id="banco" maxlength="45"/>
                    </div>
                    <div id="divCONTA" class="form-group">
                        <label>Conta:</label>
                        <input class="form-control" value="<?=isset($dados[0]['num_conta']) ? $dados[0]['num_conta'] : ''?>" name="conta" id="conta" maxlength="12"/>
                    </div>
                    <div id="divAGENCIA" class="form-group">
                        <label>Agência:</label>
                        <input class="form-control" value="<?=isset($dados[0]['num_agencia']) ? $dados[0]['num_agencia'] : ''?>" name="agencia" id="agencia" maxlength="6"/>
                    </div>
                    <div class="form-group">
                        <label>Saldo:</label>
                        <div id="divSALDO" class="form-group input-group">
                            <span class="input-group-addon">R$</span>
                            <input type="text" class="form-control" value="<?=isset($dados[0]['valor_saldo']) ? $dados[0]['valor_saldo'] : ''?>" name="saldo" id="saldo">
                            
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success" name="btn-salvar" onclick="return validarConta()">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger ">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    <b>Deseja excluir a conta:</b> <?= $dados[0]['nome_banco'] ?>?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary" name="btn-excluir">Sim</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>