<?php
require_once '../DAO/UtilDAO.php';
require_once '../DAO/UsuarioDAO.php';
UtilDAO::verificarLogado();
$objdao = new UsuarioDAO();
$retalterarsenha = '';

if (isset($_POST['btn-salvar'])) {
    $novasenha = $_POST['novasenha'];
    $repsenha = $_POST['repsenha'];

    $retalterarsenha = $objdao->alterarSenha($novasenha, $repsenha);
    
    if($retalterarsenha != 1){
        header('location: alterar_senha.php?ret='.$retalterarsenha);
    exit;
    }
    else if($retalterarsenha === 1){
        header('location: meus_dados.php?ret=1');
        exit;
    }
}
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
                        <?php include_once '_msg.php'; ?>
                        <h2>Altere sua senha:</h2>
                    </div>
                </div>
                <hr />
                <form action="alterar_senha.php" method="post">
                    <div id="divNSENHA" class="form-group">
                        <label>Nova senha:</label>
                        <input type="password" class="form-control" placeholder="Digite aqui" name="novasenha" id="novasenha" />
                    </div>
                    <div id="divREPSENHA" class="form-group">
                        <label>Repita nova senha:</label>
                        <input type="password" class="form-control" placeholder="Digite aqui" name="repsenha" id="repsenha" />
                    </div>
                    <button class="btn btn-success" name="btn-salvar" onclick="return validarSenhaAlt()">Salvar</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>