<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::verificarLogado();
require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/CategoriaDAO.php';
require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/ContaDAO.php';

$dao_cat = new CategoriaDAO();
$dao_emp = new EmpresaDAO();
$dao_con = new ContaDAO();
$tipo = '';
if(isset($_POST['btn-salvar'])){
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $valor= $_POST['valor'];
    $categoria= $_POST['categoria'];
    $empresa = $_POST['empresa'];
    $conta = $_POST['conta'];
    $obs = $_POST['obs'];

    $objDAO = new MovimentoDAO();
    $ret = $objDAO->cadastrarMovimento($tipo, $data, $valor, $categoria, $empresa, $conta, $obs);

    
}
$categorias = $dao_cat->consultarCategoria();
$empresas = $dao_emp->consultarEmpresa();
$contas = $dao_con->consultarConta();


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
                        <h2>Realizar movimento</h2>
                        <h5>Insira seus movimentos de entrada ou saída</h5>
                    </div>
                </div>
                <hr />
            <form action="realizar_movimento.php" method="post">
                <div class="col-md-6">
                    <div id="divTIPO" class="form-group">
                        <label>Tipo de movimento <em>(campo obrigatório):</em></label>
                        <select name="tipo" id="tipo" class="form-control">
                            <option value="">Selecione</option>
                            <option value="1">Entrada</option>
                            <option value="2">Saída</option>
                        </select>
                    </div>
                    <div id="divDATA" class="form-group">
                        <label>Data <em>(campo obrigatório)</em>:</label>
                        <input type="date" name="data"  class="form-control" placeholder="Ex.: 01/01/2023" id="data" />
                    </div>
                    <div id="divVALOR" class="form-group">
                        <label>Valor <em>(campo obrigatório)</em>:</label>
                        <div class="form-group input-group">
                            <span class="input-group-addon">R$</span>
                            <input name="valor"  class="form-control" id="valor"/>
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div id="divCATEGORIA" class="form-group">
                        <label>Categoria <em>(campo obrigatório):</em></label>
                        <select class="form-control" id="categoria" name="categoria">
                            <option value="">Selecione</option>
                            <?php foreach($categorias as $item) { ?>
                                <option value="<?=$item['id_categoria']?>"> <?= $item['nome_categoria'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div id="divEMPRESA" class="form-group">
                        <label>Empresa <em>(campo obrigatório)</em>:</label>
                        <select name="empresa" id="empresa" class="form-control">
                            <option value="">Selecione</option>
                            <?php foreach($empresas as $item) {?>
                                <option value="<?=$item['id_empresa']?>"> <?=$item['nome_empresa'] ?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div id="divCONTA" class="form-group">
                        <label>Conta <em>(campo obrigatório)</em>:</label>
                        <select name="conta" id="conta" class="form-control">
                            <option value="">Selecione</option>
                            <?php foreach($contas as $item){ ?>
                                <option value="<?= $item['id_conta']?>"><?= 'Banco: '.$item['nome_banco'].' | Agência: '.$item['num_agencia'].' | Conta: '.$item['num_conta']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Observações</label>
                        <textarea name="obs"  class="form-control" rows="3"></textarea>
                    </div>
                </div>
                    <button name="btn-salvar" type="submit" class="btn btn-success" onclick="return validarMovimentoNew()" >Salvar</button>
                    <a href="cons_movimento.php" class="btn btn-info">Consultar movimentos lançados</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>