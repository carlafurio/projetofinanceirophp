<?php 
require_once '../DAO/UsuarioDAO.php';
require_once '../DAO/UtilDAO.php';
$objdao = new usuarioDAO();
if(isset($_POST['btn-acessar'])){
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $ret = $objdao->validarLogin($email, $senha);
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">
                <br /><br />
                <h2>Controle Financeiro</h2>
                <h5>Faça seu login</h5>
                <br />
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> Entre com seus dados </strong>
                    </div>
                    <div class="panel-body">
                        <?php include_once '_msg.php' ?>
                        <form action="login.php" method="post">                       
                            <div class="form-group input-group" id="divEMAIL">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Seu e-mail " value="<?= isset($email) ? $email : '' ?>"/>
                            </div>
                            <div class="form-group input-group" id="divSENHA">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" name="senha" id="senha" placeholder="Sua senha" />
                            </div>                            
                            <div>
                                    <button name="btn-acessar"  class="btn btn-primary" onclick="return validarLogin()">Acessar</button>
                                 | Não possui conta? <a href="cadastro.php">Cadastre-se </a>
                            </div>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>
</body>

</html>