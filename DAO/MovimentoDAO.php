<?php
require_once 'Conexao.php';
require_once 'UtilDAO.php';




class MovimentoDAO extends Conexao
{

    public function cadastrarMovimento($tipo, $data, $valor, $categoria, $empresa, $conta, $obs)
    {
        if ($tipo == '' || trim($data) == '' || trim($valor) == '' || $categoria == '' || $empresa == '' || $conta == '') {
            return 0;
        }


        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_mov
                        (tipo_mov, data_mov, valor_mov, obs_mov, id_empresa, id_conta, id_categoria, id_usuario)
                        values(?,?,?,?,?,?,?,?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $tipo);
        $sql->bindValue(2, $data);
        $sql->bindValue(3, $valor);
        $sql->bindValue(4, $obs);
        $sql->bindValue(5, $empresa);
        $sql->bindValue(6, $conta);
        $sql->bindValue(7, $categoria);
        $sql->bindValue(8, UtilDAO::CodigoLogado());

        $conexao->beginTransaction();


        try {

            //Inserçao do movimento
            $sql->execute();

            if ($tipo == 1) {
                $comando_sql = 'update tb_conta set valor_saldo = valor_saldo + ? where id_conta  = ?';
            } else if ($tipo == 2) {
                $comando_sql = 'update tb_conta set valor_saldo = valor_saldo - ? where id_conta  = ?';
            }

            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $conta);

            $sql->execute(); //atualiza o saldo da conta
            $conexao->commit();
            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            $conexao->rollBack();
            return -1;
        }
    }
    public function filtrarMovimento($tipo, $dt_inicial, $dt_final)
    {
        if (trim($dt_inicial) == '' || trim($dt_final) == '') {
            return 0;
        } 

        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT  date_format(data_mov, "%d/%m/%y") as data_mov,
                                valor_mov,
                                tipo_mov,
                                nome_categoria,
                                nome_empresa,
                                nome_banco,
                                num_conta,
                                num_agencia,
                                obs_mov,
                                tb_mov.id_mov,
                                tb_mov.id_conta
                            FROM tb_mov
                            INNER JOIN tb_categoria
                            ON tb_categoria.id_categoria = tb_mov.id_categoria
                            INNER JOIN tb_empresas
                            ON tb_empresas.id_empresa = tb_mov.id_empresa
                            INNER JOIN tb_conta
                            ON tb_conta.id_conta = tb_mov.id_conta
                            WHERE tb_mov.id_usuario = ?
                            AND tb_mov.data_mov BETWEEN ? AND ?';
        if ($tipo != 0) {
            $comando_sql .= ' AND tipo_mov = ? ';
        }

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->bindValue(2, $dt_inicial);
        $sql->bindValue(3, $dt_final);

        if ($tipo != 0) {
            $sql->bindValue(4, $tipo);
        }
        $sql->setFetchMode(pdo::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }
    public function mostrarUltimosLancamentos(){
        
            
    
            $conexao = parent::retornaConexao();
            $comando_sql = 'SELECT  date_format(data_mov, "%d/%m/%y") as data_mov,
                                    valor_mov,
                                    tipo_mov,
                                    nome_categoria,
                                    nome_empresa,
                                    nome_banco,
                                    num_conta,
                                    num_agencia,
                                    obs_mov,
                                    tb_mov.id_mov,
                                    tb_mov.id_conta
                                FROM tb_mov
                                INNER JOIN tb_categoria
                                ON tb_categoria.id_categoria = tb_mov.id_categoria
                                INNER JOIN tb_empresas
                                ON tb_empresas.id_empresa = tb_mov.id_empresa
                                INNER JOIN tb_conta
                                ON tb_conta.id_conta = tb_mov.id_conta
                                WHERE tb_mov.id_usuario = ?
                                ORDER BY tb_mov.id_mov DESC limit 10' ;
                               
           
    
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
    
            $sql->bindValue(1, UtilDAO::CodigoLogado());

            $sql->setFetchMode(pdo::FETCH_ASSOC);
            $sql->execute();
            return $sql->fetchAll();
        }
    
    public function excluirMovimento($id_mov, $id_conta, $valor, $tipo){
        if(trim($id_mov) == '' || trim($id_conta) == '' || trim($valor) == '' || trim($tipo) == ''){
            return 0;
        }
    
        $conexao = parent::retornaConexao();
        $comando_sql = 'DELETE FROM tb_mov WHERE id_mov = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $id_mov);
        $conexao->beginTransaction();

        try{
            $sql->execute();

            if($tipo == 1){
                $comando_sql = 'UPDATE tb_conta 
                                    SET valor_saldo = valor_saldo - ? 
                                    WHERE id_conta = ?';

            } else if($tipo == 2){
                $comando_sql =     'UPDATE tb_conta 
                                    SET valor_saldo = valor_saldo + ? 
                                    WHERE id_conta = ?';
            }
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $id_conta);
            $sql->execute();

            $conexao->commit();
            return 1;

        } catch (Exception $ex){
                $conexao->rollBack();
                return -1;
        }

    
    }
    public function totalEntrada(){
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT sum(valor_mov) AS total
                        FROM tb_mov
                        WHERE tipo_mov = 1 AND id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();


    }
    public function totalSaida(){
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT sum(valor_mov) AS total
                        FROM tb_mov
                        WHERE tipo_mov = 2 AND id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, UtilDAO::CodigoLogado());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();


    }

}
