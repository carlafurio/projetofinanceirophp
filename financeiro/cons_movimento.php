<?php
require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/UtilDAO.php';


$tipo = '';
$dt_inicial = '';
$dt_final = '';


if (isset($_POST['btn-pesquisar'])) {
    $tipo = $_POST['tipo'];
    $dt_inicial = $_POST['dt_inicial'];
    $dt_final = $_POST['dt_final'];
    $dao = new MovimentoDAO();
    
    $movs = $dao->filtrarMovimento($tipo, $dt_inicial, $dt_final);

} else if (isset($_POST['btn-excluir'])){
    $id_mov = $_POST['id_mov'];
    $id_conta = $_POST['id_conta'];
    $valor_mov = $_POST['valor_mov'];
    $tipo_mov = $_POST['tipo_mov'];
    $dao = new MovimentoDAO();

    $ret = $dao->excluirMovimento($id_mov, $id_conta, $valor_mov, $tipo_mov);
    

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
                        <h2>Consultar contas cadastradas</h2>
                        <h5>Todas as contas </h5>
                    </div>
                </div>
                <hr />
                <form action="cons_movimento.php" method="post">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo de movimento</label>
                            <select class="form-control" name="tipo">
                                <option value="0" <?= $tipo == 0 ? 'selected' : '' ?>>Todos</option>
                                <option value="1" <?= $tipo == 1 ? 'selected' : '' ?>>Entrada</option>
                                <option value="2" <?= $tipo == 2 ? 'selected' : '' ?>>Saída</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6" >
                        <div class="form-group" id="divDt_inicial">
                            <label>Data inicial:</label>
                            <input type="date" class="form-control" placeholder="Ex.: 01/01/2023" id="dt_inicial" name="dt_inicial" value="<?= $dt_inicial ?>" />
                        </div>
                    </div>
                    <div class="col-md-6" >
                        <div class="form-group" id="divDt_final">
                            <label>Data final:</label>
                            <input type="date" class="form-control" placeholder="Ex.: 01/01/2023" id="dt_final" name="dt_final" value="<?= $dt_final ?>" />
                        </div>
                    </div>
                    <button class="btn btn-info" name="btn-pesquisar" onclick="return validarConsultaMov()">Pesquisar</button>
                </form>
                <hr>
                <?php if (isset($movs)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Resultado encontrado
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Tipo</th>
                                                    <th>Data</th>
                                                    <th>Valor</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Banco</th>
                                                    <th>Conta</th>
                                                    <th>Observações</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $total = 0;
                                                foreach ($movs as $item) {
                                                    if ($item['tipo_mov'] == 1) {
                                                        $total = $total + $item['valor_mov'];
                                                    } else {
                                                        $total = $total - $item['valor_mov'];
                                                    }
                                                ?>
                                                <tr class="odd gradeX">
                                                        <td><?= UtilDAO::NomeTipoMovimento($item['tipo_mov']) ?></td>
                                                        <td><?= $item['data_mov'] ?></td>
                                                        <td><?= $item['valor_mov'] ?></td>
                                                        <td><?= $item['nome_categoria'] ?></td>
                                                        <td><?= $item['nome_empresa'] ?></td>
                                                        <td><?= $item['nome_banco'] ?></td>
                                                        <td><?= $item['num_conta'] ?></td>
                                                        <td><?= $item['obs_mov'] ?></td>
                                                        <td><button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalExcluir<?=$item['id_mov']  ?>" >Excluir</button>
                                                            <div class="modal fade" id="modalExcluir<?=$item['id_mov']  ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                            <h4 class="modal-title" id="myModalLabel">Confirmação de Exclusão</h4>
                                                                        </div>
                                                                        <form action="cons_movimento.php" method="post">
                                                                            <input type="hidden" name="id_mov" value="<?=$item['id_mov']?>">
                                                                            <input type="hidden" name="id_conta" value="<?=$item['id_conta']?>">
                                                                            <input type="hidden" name="valor_mov" value="<?=$item['valor_mov']?>">
                                                                            <input type="hidden" name="tipo_mov" value="<?=$item['tipo_mov']?>">
                                                                        <div class="modal-body">
                                                                            <b>Deseja excluir o movimento: </br></b>
                                                                            <b>Tipo: </b><?= UtilDAO::NomeTipoMovimento($item['tipo_mov']) ?> <br>
                                                                            <b>Data: </b><?= $item['data_mov'] ?><br>
                                                                            <b>Valor: </b><?=  number_format($item['valor_mov'], 2, ',', '.') ?><br>
                                                                            <b>Categoria: </b><?= $item['nome_categoria'] ?><br>
                                                                            <b>Empresa: </b><?= $item['nome_empresa'] ?><br>
                                                                            <b>Banco: </b><?=$item['nome_banco'] ?> | <b>Conta: </b> <?= $item['num_conta'] ?><br>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                                            <button type="submit" class="btn btn-primary" name="btn-excluir">Sim</button>
                                                                        </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <div class="total-movimento"> Total: <label style="color: <?= $total < 0 ? 'red' : 'green' ?>;">
                                        R$ <?= number_format($total, 2, ',', '.'); ?></label></div>
                                    </div>
                                </div>
                            </div>
                            <!--End Advanced Tables -->
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</body>

</html>