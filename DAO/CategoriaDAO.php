<?php
require_once 'Conexao.php';
require_once 'UtilDAO.php';
class categoriaDAO extends Conexao
{
    public function cadastrarCategoria($nome)
    {
        if (trim($nome) == '') {
            return 0;
        }
        //passo 1: criar variavel q recb o obj de conex.
        $conexao = parent::retornaConexao();
        //passo 2: criar variavel q recb o txt comd sql q devera ser execut. no BD
        $comando_sql = 'insert into tb_categoria (nome_categoria, id_usuario) values (?, ?)'; //valores dinamicos usamos os ? 
        //passo 3: criar um obj que sera configurado para levar as info para o bd
        $sql = new PDOStatement();
        //passo 4: colocar dentro do obj sql a conexao preparada para executar o comando_sql
        $sql = $conexao->prepare($comando_sql);
        //passo 5: verificar se no comando_sql tem um ? para ser configurado, se s, conf os bindValues(valor vinculado)
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        //tratamento de erro
        try {
            //passo 6: executar no BD
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            //echo $ex->getMessage();//retorna msg do erro
            return -1;
        }
    }

    public function excluirCategoria($idCategoria){
        if($idCategoria == ''){
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'delete from tb_categoria
                            where id_categoria = ?
                            and id_usuario = ?';

        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            return 1;
        }catch(Exception $ex){
            return -5;
        }



    }

    public function consultarCategoria(){
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_categoria, nome_categoria
                            from tb_categoria
                            where id_usuario = ? order by nome_categoria ASC';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();
        return $sql->fetchAll();


    }

    public function alterarCategoria($nome, $idcategoria)
    {
        if (trim($nome) == '' || $idcategoria == '') {
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'update tb_categoria 
                            set nome_categoria = ?  
                            where id_categoria = ? 
                            and id_usuario = ?'; //id_categoria
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $idcategoria);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try {
            $sql->execute();
            return 1;
        } catch (Exception $ex) {
            return -1;
        }
    }

    public function detalharCategoria($idCategoria){
        $conexao = parent::retornaConexao();
        $comando_sql = 'select id_categoria, 
                            nome_categoria
                                from tb_categoria
                                where id_categoria = ?
                                    and id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        return $sql->fetchAll();
    }
}
