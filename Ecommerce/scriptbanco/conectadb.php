<?php
#conecta com o servidor (xampp)
$servidor = "127.0.0.1";
#nome do banco
$banco = "ecommerce";
#nome do usuario
$usuario = "adm";
#senha do usuario
$senha = "123";
#link de conexao com o banco
$link = mysqli_connect($servidor, $usuario, $senha, $banco);
?>