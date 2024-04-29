<?php
require_once 'Conexao.php';
require_once 'UtilDAO.php';
class ContaDAO extends Conexao{ 
    public function cadastrarConta($banco, $agencia, $conta, $saldo){
        if(trim($banco) == '' || trim($agencia) == '' || trim($conta) == '' || trim($saldo) == '')
        return 0;
        if(!is_numeric($saldo))
        return -5;

        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_conta
        (nome_banco, num_conta, num_agencia, valor_saldo, id_usuario)
        values (?, ?, ?, ?, ?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $conta);
        $sql->bindValue(3, $agencia);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;
        }
        catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }

    }

    public function consultarConta(){
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_conta, nome_banco, num_conta, num_agencia, valor_saldo
                        from tb_conta
                        where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function detalharConta($idConta){
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_conta, nome_banco, num_conta, num_agencia, valor_saldo
                            from tb_conta
                            where id_conta = ? and id_usuario = ? ORDER BY nome_banco ASC';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }

    public function alterarConta($idConta, $banco, $conta, $agencia, $saldo){
        if(trim($banco) == '' || trim($agencia) == '' || trim($conta) == '' || trim($saldo) == '' || $idConta == '')
        return 0;
        if(!is_numeric($saldo))
        return -5;
        $conexao = parent::retornaConexao();
        $comando_sql = 'update tb_conta
                        set nome_banco = ?, num_conta = ?, num_agencia = ?, valor_saldo = ?
                            where id_conta = ? and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $conta);
        $sql->bindValue(3, $agencia);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, $idConta);
        $sql->bindValue(6, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;

        }catch(Exception $ex){
            return -1;
        }


    }

    public function excluirConta($idConta){
        if($idConta == ''){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'delete from tb_conta
                        where id_conta = ? 
                            and id_usuario = ?';
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idConta);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;

        }catch(Exception $ex){
            return -5;
        }
    }

}