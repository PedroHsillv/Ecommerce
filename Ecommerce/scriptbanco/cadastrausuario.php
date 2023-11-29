<?php
#INICIA A CONEXÃO COM O BANCO DE DADOS
include("cabecalho.php");

#COLETA DE VARIÁVEIS VIA FORMULÁRIO DE HTML
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d])/', $senha)) 
        #(?=.*[a-z]): Pelo menos 1 letra minúscula.
        #(?=.*[A-Z]): Pelo menos 1 letra maiúscula.
        #(?=.*\d): Pelo menos 1 numeral.
        #(?=.*[^a-zA-Z\d]): Pelo menos 1 caractere especial 

    #PASSANDO INSTRUÇÕES SQL PARA O BANCO
    #VALIDANDO SE USUARIO EXISTE
    $sql = "SELECT COUNT(usu_id) FROM usuarios WHERE usu_nome = '$nome'";
    $retorno = mysqli_query($link, $sql);
    while ($tbl = mysqli_fetch_array($retorno)) {
        $cont = $tbl[0];
    }
    #VERIFICAÇÃO SE USUARIO EXISTE, SE EXISTE = 1 SENÃO = 0
    if ($cont > 0) {
        echo "<script>window.alert('USUARIO JÁ CADASTRADO!');</script>";
    } else {
        $molho = md5(rand() . date('H:i:s'));
        $senha = md5($senha . $molho);

        $sql = "INSERT INTO usuarios (usu_nome, usu_senha, usu_ativo, usu_molho) 
        VALUES('$nome', '$senha', 's', '$molho')";

        mysqli_query($link, $sql);
        echo "<script>window.alert('USUARIO CADASTRADO');</script>";
        echo "<script>window.location.href='cadastrausuario.php';</script>";
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="./css/estiloadm4.css">
    <title> Cadastrar Usuario</title>
</head>
<body>

<div>
    <form action="cadastrausuario.php" method="post">

        <input type = "text" name = "nome" id = "nome" 
        placeholder="Nome de Usuario">
        <p></p>
        <input type = "password" name = "senha" id = "senha" 
        placeholder="Senha">
        <p></p>
        <input type = "submit" name = "cadastrar" id = "cadastrar" 
        placeholder="Cadastrar">

    </form>
</div>
</body>
</html>