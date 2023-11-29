<?php 
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include('conectadb.php');
    $emai = $_POST['emial'];
    $cod = $_POST['cod'];
    $senha = $_POST['senha'];

    if($cod==""){
        header("Location:redefine_senha.php?msg=Codigo Invalido!");
        exit();
    }
    $sql="SELECT COUNT(cli_id) FROM clientes WHERE cli_email = '$email' AND cli_recupera = '$cod'";
    $result = mysqli_query($link, $sql);
    while($tbl = mysqli_fetch_array($result)){
        $cont = $tbl[0];
    }
    if($cont == 0){
        $sql ="UPDATE clientes SET cli_recupera = '' WHERE cli_email = '$emai' ";
        mysqli_query($link,$sql);
        header("Location:redefine_senha.php?msg=Codigo Invalido! Solite um novo codigo")
        exit();
    }
    else{
        $random = rand();
        $molho = md5(rand() . date('H:i:s'));
        $senha = md5($senha . $molho);
        $sql = "UPDATE clientes SET cli_senha ='$senha', cli_molho = '$molho', cli_recupera=$random WHERE cli_email = '$email'";
        mysqli_query($link,$sql);
        header("Location:redefine_senha.php?msg=Senha Alterada com sucesso!");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
</head>
<body>
    <main>

    <form action="redefinesenha.php" method="POST">
        <h1>REDEFINIR SENHA</h1>
        <input type="text" name="email" id="email" placeholder="Email" required>
        <p></p>
        <input type="text" name="cod" placeholder="Codigo" required>
        <p></p>
        <input type="password" name="senha" id="senha" placeholder="Senha" required>
        <p></p>
        <input type="text" name="login" value="REDEFINIR">
    </form>

        <p id="msg">
            <?php
            if(isset($_GET['msg'])){
                echo($_GET['msg']);
                if($_GET['msg'] == "Usuario ou Senha Incorretos")
                {
                    echo("<br><a href='recuperasenha.php'>Esqueci minha Senha</a>");
                }
            }
            ?>
        </p>
    </mais>
</body>
</html>