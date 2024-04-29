<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/CategoriaDAO.php';
if(isset($_POST['btn-salvar'])){
    $nome = $_POST['nome'];
    $objdao = new CategoriaDAO();

    $ret = $objdao->cadastrarCategoria($nome);


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
                        <h2>Nova categoria</h2>
                        <h5>Cadastre uma nova categoria</h5>
                    </div>
                </div>
                <hr />
                <form action="nova_categoria.php" method="post">
                    <div id="divCATEGORIA" class="form-group">
                        <label>Nome da categoria <em>(campo obrigatório)</em>:</label>
                        <input class="form-control" name="nome" placeholder="Ex.: Conta de luz" id="categoria" maxlength="35" />
                    </div>
                    <button type="submit" name="btn-salvar" onclick="return validarCategoria()" class="btn btn-success">Salvar</button>
                    <a href="cons_categoria.php" class="btn btn-info">Consultar categorias cadastradas</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>