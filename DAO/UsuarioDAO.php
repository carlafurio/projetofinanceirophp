<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class usuarioDAO extends Conexao
{
    public function carregarMeusDados(){
        $conexao = parent::retornaConexao();
        $comando_sql = 'select nome_usuario, email_usuario
                            from tb_usuario 
                                where id_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());
        
        //remove os index dentro do array, permanecendo somente as colunas do BD
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }
    public function gravarMeusDados($nome, $email)
    {
        if (trim($nome) == '' || trim($email) == '')
            return 0;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return -4;
        }
        if($this->verificarEmailDuplicadoAlteracao($email) != 0){
            return -6;
        }

        // se estiver vazio retorna 0;

        $conexao = parent::retornaConexao();
        $comando_sql = 'update tb_usuario
                            set nome_usuario = ?, email_usuario = ?
                        where id_usuario = ?';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);

        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try{
            $sql->execute();
            UtilDAO::atualizarSessaoNome($nome);
            return 1;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;

        }

    }

    public function gravarNovoCadastro($nome, $email, $senha, $repsenha)
    {
        $patternSenha = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/';
        if (trim($nome) == '' || trim($email) == '' || trim($senha) == '')
            return 0;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return -4;
        }
        if (strlen($senha) < 6)
            return -2;
        if(!preg_match($patternSenha, $senha)){
            return -8;
        }
            
        if ($repsenha != $senha)
            return -3;
        if($this->verificarEmailDuplicado($email) != 0) {
            return -6;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'INSERT INTO tb_usuario  
                        (nome_usuario, email_usuario, senha_usuario, data_cadastro)
                        VALUES
                        (?, ?, ?, ?)';
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $nome); //bindValue vincula valor a um campo
        $sql->bindValue(2, $email);

        $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

        $sql->bindValue(3, $senha_hash);
        $sql->bindValue(4, date('Y-m-d'));

        try{
            $sql->execute();
            return 2;
        }catch(Exception $ex){
            echo $ex->getMessage();
            return -1;
        }

    }
    public function verificarSenha($senha){
        
        if(trim($senha) == ''){
            return 0;
        }
        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT senha_usuario
                            FROM tb_usuario
                                WHERE id_usuario = ?';
        
        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        $senhaatual = $sql->fetchAll();

        if (!password_verify($senha, $senhaatual[0]['senha_usuario'])){
            return -9;

        } else {
            return 3;
        }     
    }
    public function alterarSenha($senha, $repsenha){
        $patternSenha = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/';
        if (trim($senha) == '')
            return 0;
        if (strlen($senha) < 6)
            return -2;
        if ($repsenha != $senha)
            return -3;
        if(!preg_match($patternSenha, $senha)){
            return -8;
        }            

            $conexao = parent::retornaConexao();
            $comando_sql = 'update tb_usuario
                                set senha_usuario = ?
                            where id_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);

            $senha_hash = password_hash($senha, PASSWORD_DEFAULT);
    
            $sql->bindValue(1, $senha_hash);
            $sql->bindValue(2, UtilDAO::CodigoLogado());
    
            try{
                $sql->execute();
                return 1;
            }catch(Exception $ex){
                echo $ex->getMessage();
                return -1;
    
            }

    }
    public function validarLogin($email, $senha){
        if (trim($email) == '' || trim($senha) == ''){
            return 0;
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                return -4;
        }
            $conexao = parent::retornaConexao();
            $comando_sql = 'SELECT id_usuario, nome_usuario, senha_usuario 
                                FROM tb_usuario
                                    WHERE email_usuario = ?';
            $sql = new PDOStatement();
            $sql = $conexao->prepare($comando_sql);
            $sql->bindValue(1, $email);
            // $sql->bindValue(2, $senha);

            $sql->setFetchMode(PDO::FETCH_ASSOC);
            $sql->execute();
            $user = $sql->fetchAll();



            if(count($user) == 0){
                return -7;
            }
            $senha_armazenada = $user[0]['senha_usuario'];


            if (!password_verify($senha, $senha_armazenada)) {
                return -9;
            }


            $cod = $user[0]['id_usuario'];
            $nome = $user[0]['nome_usuario'];
            UtilDAO::criarSessao($cod, $nome);
            header('location: inicial.php');
            exit;            
    }   
    public function verificarEmailDuplicado($email){
        if(trim($email) == ''){
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT count(email_usuario) AS contar
                        FROM tb_usuario 
                        WHERE email_usuario = ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $email);

        $sql->setFetchMode(PDO::FETCH_ASSOC); //remove index das colunas do array
        $sql->execute();

        $contar = $sql->fetchAll();
        return $contar[0]['contar'];
    }
    public function verificarEmailDuplicadoAlteracao($email){
        if(trim($email) == ''){
            return 0;
        }

        $conexao = parent::retornaConexao();
        $comando_sql = 'SELECT count(email_usuario) AS contar
                        FROM tb_usuario 
                        WHERE email_usuario = ? AND id_usuario != ?';

        $sql = new PDOStatement();
        $sql = $conexao->prepare($comando_sql);
        $sql->bindValue(1, $email);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        $contar = $sql->fetchAll();
        return $contar[0]['contar'];
    }
}
