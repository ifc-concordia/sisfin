<?php

include ("include/config.php");
$usuario = $_POST["identificacao"];
$senha = $_POST["senha"];
$sql = mysql_query("SELECT * FROM usuario WHERE login='$usuario' and senha='$senha' ");
$qregistro = mysql_num_rows($sql);
$obj = mysql_fetch_object($sql);
$tipo = $obj->tipo;
if($qregistro < 1){
   echo "Login ou senha errado(s)!!";
}else if (($tipo == 'F')||($tipo == "T")){
   session_start();
   $_SESSION['nome_usuario']=$usuario;
   $_SESSION['senha_usuario']=$senha;
   $_SESSION['tipo']=$tipo;
   $_SESSION['idusuario']=$obj->idusuario;
   header("Location: index.php");
}else if
($tipo == 'A'){
   header("Location: http://www.dpf.gov.br/"); //Só pra assustar se um aluno bocó quiser logar no sistema administrativo MUHAHAHAHAHAHAHA by:Edson Fernando Pagliochi
}
?>