<?php
    session_start(); #INICIA SESSÃO
    include("conectadb.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST["nomeusuario"];
        $senha = $_POST["senha"];


        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z\d])/', $senha)) 
        #(?=.*[a-z]): Pelo menos 1 letra minúscula.
        #(?=.*[A-Z]): Pelo menos 1 letra maiúscula.
        #(?=.*\d): Pelo menos 1 numeral.
        #(?=.*[^a-zA-Z\d]): Pelo menos 1 caractere especial 
        
        #BUSCA A molho
        $sql = "SELECT cli_molho FROM clientes WHERE cli_nome = '$nome'";
        $retorno = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($retorno)) {
            $molho = $tbl[0];
        }

        $senha = md5($senha . $molho);

        $sql = "SELECT COUNT(cli_id) FROM clientes WHERE cli_nome = '$nome' AND cli_senha = '$senha'";
        $retorno = mysqli_query($link, $sql);
        while ($tbl = mysqli_fetch_array($retorno)) {
            $cont = $tbl[0];
        } 

        if ($cont == 1) {
            $sql = "SELECT * FROM clientes WHERE cli_nome = '$nome' AND cli_senha = '$senha' AND cli_ativo = 's'";
            $retorno = mysqli_query($link, $sql);
            while ($tbl = mysqli_fetch_array($retorno)) {
                $_SESSION['idusuario'] = $tbl[0];
                $_SESSION['nomeusuario'] = $tbl[1];
            }
            echo "<script>window.location.href='loja.php';</script>";
        } else {
            echo "<script>window.alert('USUARIO OU SENHA INCORRETOS');</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm4.css">
    <title>Login Clientes</title>
</head>
<body>
    <br><br><br><br><br><br><br><br><br><br><br>
    <form action="loginclientes.php" method="POST">
    <h1>LOGIN CLIENTES</h1>
    <input type="text" name="nomeusuario" id="nome" placeholder="Nome">
    <p></p>
    <input type="password" id="senha" name="senha"  placeholder="Senha">
    <p></p>
    <input type="submit" name="login" value="LOGIN">
    </form>
    <div align="center">
        <button onclick="location.href='cadastracliente.php'">Cadastrar Cliente</button>
        <button onclick="location.href='recuperasenha.php'">Recuperar Senha</button>
    </div>
</body>
</html>