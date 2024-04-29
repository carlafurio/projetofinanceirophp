<?php
require_once 'Conexao.php';
require_once 'UtilDAO.php';
class EmpresaDAO extends Conexao
{

    public function cadastrarEmpresa($nome, $telefone, $endereco)
    {
        if (trim($nome == ''))
            return 0;

        $conexao = parent::retornaConexao();
        $comando_sql = 'insert into tb_empresas
                    (nome_empresa, tel_empresa, endereco_empresa, id_usuario)
                    values
                    (?, ?, ?, ?);';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $telefone);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            //echo $ex->getMessage();
            return -1;
        }
    }

    public function consultarEmpresa()
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_empresa, nome_empresa, tel_empresa, endereco_empresa
                            from tb_empresas
                            where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function detalharEmpresa($idEmpresa)
    {
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_empresa, nome_empresa, tel_empresa, endereco_empresa
                    from tb_empresas
                        where id_empresa = ? and id_usuario = ? ORDER BY nome_empresa ASC';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();

    }

    public function alterarEmpresa($idEmpresa, $nome, $telefone, $endereco)
    {
        if (trim($nome) == '' || $idEmpresa == '') {
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'update tb_empresas
                            set nome_empresa = ?, tel_empresa = ?, endereco_empresa = ?
                            where id_empresa = ? and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $telefone);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, $idEmpresa);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function excluirEmpresa($idEmpresa){
        if($idEmpresa == ''){
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'delete from tb_empresas 
                            where id_empresa = ?
                                and id_usuario = ?';
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            return -5;
        }
    }
}
