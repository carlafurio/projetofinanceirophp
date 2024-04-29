<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/UsuarioDAO.php';
$objdao = new UsuarioDAO();
if (isset($_POST['btn-salvar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];


    $ret = $objdao->gravarMeusDados($nome, $email);
}

    $dados = $objdao->carregarMeusDados();
   // echo '<pre>';
    //print_r($dados);
    //echo '</pre>';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">
        <?php
        include_once '_topo.php';
        include_once '_menu.php';
        ?>
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <?php include_once '../financeiro/_msg.php'; ?>
                        <h2>Meus dados</h2>
                        <h5>Atualize seus dados: </h5>
                    </div>
                </div>
                <hr />
                <form action="meus_dados.php" method="post">
                    <div id="divNOME" class="form-group">
                        <label>Seu nome <em>(campo obrigatório)</em>:</label>
                        <input class="form-control" placeholder="Digite aqui" name="nome" maxlength="50" id="nome" value="<?= $dados[0]['nome_usuario'] ?>"/>
                    </div>
                    <div id="divEMAIL" class="form-group">
                        <label>Seu e-mail <em>(campo obrigatório)</em>:</label>
                        <input class="form-control" placeholder="Digite aqui" name="email" id="email" value="<?= $dados[0]['email_usuario']?>" />
                    </div>
                    <!-- return false mantem na pag -->
                    <button class="btn btn-success" name="btn-salvar" onclick="return validarMeusDados()">Salvar</button>
                    <a class="btn btn-info" href="alt_validarsenha.php">Alterar Senha</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>