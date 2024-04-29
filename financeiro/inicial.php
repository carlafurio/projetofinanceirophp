<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerificarLogado();
require_once '../DAO/MovimentoDAO.php';
$dao = new MovimentoDAO();

$total_entrada = $dao->totalEntrada();
$total_saida = $dao->totalSaida();
$movs = $dao->mostrarUltimosLancamentos();

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
                        <h2>Página Inicial</h2>
                        <h5>Aqui você pode acompanhar os dados de uma forma geral: </h5>
                    </div>
                </div>
                <hr />
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-green">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>R$ <?= number_format($total_entrada[0]['total'], 2, ',', '.') ?> </h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                            Total de Entradas
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="panel panel-primary text-center no-boder bg-color-red">
                        <div class="panel-body">
                            <i class="fa fa-bar-chart-o fa-5x"></i>
                            <h3>R$ <?= number_format($total_saida[0]['total'], 2, ',', '.') ?> </h3>
                        </div>
                        <div class="panel-footer back-footer-red">
                            Total de Saídas

                        </div>
                    </div>
                </div>
                <hr>
                <?php if (count($movs) > 0) { ?>
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
                                                        <td>R$ <?= number_format($item['valor_mov'], 2, ',', '.') ?></td>
                                                        <td><?= $item['nome_categoria'] ?></td>
                                                        <td><?= $item['nome_empresa'] ?></td>
                                                        <td><?= $item['nome_banco'] ?></td>
                                                        <td><?= $item['num_conta'] ?></td>
                                                        <td><?= $item['obs_mov'] ?></td>
                                                        </td>
                                                    </tr>
                                                <?php }  ?>   
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
                <?php } else { ?>
                    <div class="alert alert-info col-md-12">
                        Não existe movimentos para serem mostrado!
                    </div>
                <?php } ?>
            </div>

        </div>
    </div>
</body>

</html>