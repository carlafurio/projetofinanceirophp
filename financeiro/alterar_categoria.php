<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/CategoriaDAO.php';
$dao = new categoriaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idCategoria = $_GET['cod'];
    $dados = $dao->detalharCategoria($idCategoria);

    //se tem alguma coisa dentro do array $dados:

    if (count($dados) == 0) {
        header('location: cons_categoria.php');
        exit;
    }
} else if (isset($_POST['btn-salvar'])) {
    $idCategoria = $_POST['cod'];
    $nomecategoria = $_POST['categoria'];
    $ret = $dao->alterarCategoria($nomecategoria, $idCategoria);

    header('location: cons_categoria.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btn-excluir'])) {
    $idCategoria = $_POST['cod'];
    $ret = $dao->excluirCategoria($idCategoria);

    header('location: cons_categoria.php?ret=' . $ret);
    exit;
} else {
    header('location: cons_categoria.php');
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
                        <h2>Alterar categoria</h2>
                        <h5>Altere sua categoria</h5>
                    </div>
                </div>
                <hr />
                <form action="alterar_categoria.php" method="post">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_categoria'] ?>">
                    <div id="divCATEGORIA" class="form-group">
                        <label>Nome da categoria <em>(campo obrigatório):</em></label>
                        <input class="form-control" placeholder="Ex.: Conta de luz" name="categoria" id="categoria" value="<?= $dados[0]['nome_categoria'] ?>" maxlength="35" />
                    </div>
                    <button type="submit" class="btn btn-success" name="btn-salvar" onclick="return validarCategoria()">Salvar</button>
                    <button type="button" data-toggle="modal" data-target="#modalExcluir" class="btn btn-danger ">Excluir</button>
                    <div class="modal fade" id="modalExcluir" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                </div>
                                <div class="modal-body">
                                    <b>Deseja excluir a categoria:</b> <?= $dados[0]['nome_categoria'] ?>?
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