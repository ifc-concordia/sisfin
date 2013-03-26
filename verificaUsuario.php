<?php

include "include/config.php";
if (!isset($_SESSION)) {
    session_start();
}
//session_start();

//$enderecoIPRequisicao = $_SERVER['REMOTE_ADDR'];
//$navegadorRequisicao = $_SERVER['HTTP_USER_AGENT'];
//
//if (($enderecoIPRequisicao != $_SESSION['enderecoIP']) OR ($navegadorRequisicao != $_SESSION['navegador'])) {
//    session_destroy();
//    header("Location: login.php");
//}


//*/coleta os dados existentes no vetor.../*
if (IsSet($_SESSION['nome_usuario']))
    $nome_usuario = $_SESSION['nome_usuario'];
if (IsSet($_SESSION['senha_usuario']))
    $senha_usuario = $_SESSION['senha_usuario'];

// */aqui verifica se temos algo registrado/*
if (!(empty($nome_usuario) OR empty($senha_usuario))) {


    $sql = mysql_query("SELECT * FROM usuario WHERE login='$nome_usuario'");
    $conta = mysql_num_rows($sql);

    if ($conta >= 1) {
        if ($senha_usuario != mysql_result($sql, 0, "senha")) {
            unset($_SESSION['nome_usuario']);
            unset($_SESSION['senha_usuario']);
            header("Location: login.php");
            exit;
        }
    } else {
        unset($_SESSION['nome_usuario']);
        unset($_SESSION['senha_usuario']);
        header("Location: login.php");
        exit;
    }
} else {
    header("Location: login.php");
    exit;
}
?>
