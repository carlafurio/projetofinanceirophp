<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/EmpresaDAO.php';
$dao = new EmpresaDAO();


if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {
    $idEmpresa = $_GET['cod'];
    $dados = $dao->detalharEmpresa($idEmpresa);

    if (count($dados) == 0) {
        header('location: cons_empresa.php');
        exit;
    }
} else if (isset($_POST['btn-salvar'])) {
    $idEmpresa = $_POST['cod'];
    $nomeempresa = $_POST['nomeempresa'];
    $telempresa = $_POST['telempresa'];
    $enderecoempresa = $_POST['enderecoempresa'];

    $ret = $dao->alterarEmpresa($idEmpresa, $nomeempresa, $telempresa, $enderecoempresa);
    if($ret === 1){
        header('location: cons_empresa.php?ret=1');
        exit;
    }


} else if (isset($_POST['btn-excluir'])) {
    $idEmpresa = $_POST['cod'];
    $ret = $dao->excluirEmpresa($idEmpresa);

    header('location: cons_empresa.php?ret='.$ret);
    exit;
} else {
    header('location: cons_empresa.php');
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
                        <h2>Alterar empresa</h2>
                        <h5>Altere os dados da empresa</h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_empresa.php" method="post">
                    <input type="hidden" name="cod" value="<?= isset($dados[0]['id_empresa']) ? ($dados[0]['id_empresa']) : '' ?>">
                    <div id="divEMPRESA" class="form-group">
                        <label>Nome <em>(campo obrigatório):</em></label>
                        <input class="form-control" name="nomeempresa" id="nomeempresa" value="<?= isset($dados[0]['nome_empresa']) ? $dados[0]['nome_empresa'] : '' ?>" maxlength="45"/>
                    </div>
                    <div id="divTELEFONE" class="form-group">
                        <label>Telefone:</label>
                        <input class="form-control" name="telempresa" id="telefone" value="<?= isset($dados[0]['tel_empresa']) ? $dados[0]['tel_empresa'] : ''?>" maxlength="11" />
                    </div>
                    <div id="divENDERECO" class="form-group">
                        <label>Endereço:</label>
                        <input class="form-control" name="enderecoempresa" id="endereco" value="<?= isset($dados[0]['endereco_empresa']) ? $dados[0]['endereco_empresa'] : ''?>" maxlength="100"/>
                    </div>
                    <button type="submit" class="btn btn-success" name="btn-salvar" onclick="return validarEmpresa()">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger ">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    <b>Deseja excluir a empresa:</b> <?= $dados[0]['nome_empresa'] ?>?
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