<?php

class UtilDAO{
    
    //session->cria variavel no servidor e guarda la, quando deslogar vai limpar o valor
    private static function iniciarSessao(){
        if(!isset($_SESSION)){
            session_start();
        }
    }
    public static function criarSessao($cod, $nome){
        self::iniciarSessao();
        $_SESSION['cod'] = $cod;
        $_SESSION['nome'] = $nome;
    }
    public static function CodigoLogado(){
        
        self::iniciarSessao();
        return $_SESSION['cod'];  
    }
    public static function nomeLogado(){
        self::iniciarSessao();
        return $_SESSION['nome'];
    }
    private static function irParaLogin(){
        header('location: login.php');
        exit;

    }
    public static function deslogarUsuario(){
        self::iniciarSessao();
        unset($_SESSION['cod']);
        unset($_SESSION['nome']);
        self::irParaLogin();

    }
    public static function verificarLogado(){
        self::iniciarSessao();
        if(!isset($_SESSION['cod']) || $_SESSION['cod'] == ''){
            self::irParaLogin();
        }
    }
    public static function atualizarSessaoNome($nome){
        self::iniciarSessao();
        $_SESSION['nome'] = $nome;
    }

    public static function NomeTipoMovimento($tipo){
        $nome_tipo = '';

        switch($tipo){
            case 1:
                $nome_tipo = 'Entrada';
                break;
            case 2:
                $nome_tipo = 'Saída';
                break;
        }
        return $nome_tipo;
    }



}
