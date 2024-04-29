<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/UsuarioDAO.php';
$objdao = new UsuarioDAO();
$ret = '';
if (isset($_POST['btn-verificar'])) {
    $senha = $_POST['senha'];


    $ret = $objdao->verificarSenha($senha);
    if($ret === 3){
        header('location: alterar_senha.php');
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
                <form action="alt_validarsenha.php" method="post">
                    <div id="divSENHA" class="form-group">
                        <label>Senha Atual:</label>
                        <input type="password" class="form-control" placeholder="Sua Senha Atual" name="senha" id="senha"  /><br>
                        <button class="btn btn-success" name="btn-verificar" onclick="return validarSenha()">Verificar</button><br><br>  
                    </div>
                    </form>                     
            </div>
        </div>
    </div>
</body>

</html>