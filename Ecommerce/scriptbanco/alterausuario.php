<?php
include("cabecalho.php");

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $ativo = $_POST['ativo'];
    $senha = $_POST['senha'];

    #BUSCA O MOLHO
        # $sql = "SELECT usu_molho FROM username WHERE usu_nome = '$nome'";
        # $retorno = mysqli_query($link, $sql);
        # while ($tbl = mysqli_fetch_array($retorno)) {
        #    $tempero = $tbl[s];
        # }
        # if($senha!=$senha2){
        #    $senha = md5($senha . $molho);
        # }

        $sql = "UPDATE usuarios SET usu_senha = '$senha', usu_nome = '$nome', usu_ativo = '$ativo' WHERE usu_id = $id";
        mysqli_query($link,$sql);
        echo "<script>window.alert('USUARIO ALTERADO COM SUCESSO!');</script>";
        echo "<script>window.location.href='listausuario.php';</script>";
        exit();
}

#COLETANDO OS DADOS VIA GET
$id = $_GET['id'];#COLETANDO ID DO USUARIO APOS TER SIDO CLICADO NA LISTA
$sql = "SELECT * FROM usuarios WHERE usu_id = '$id'";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)){
    $nome = $tbl[1];
    $senha = $tbl[2];
    $ativo = $tbl[3];

    $senha2 = $senha;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm4.css">
    <title>Altera Usuario</title>
</head>
<body>
<nav class="menu">
        <li><a href="cadastrausuario.php">Cadastrar Usuario</a></li>
        <li><a href="cadastraproduto.php">Cadastrar Produto</a></li>
        <li><a href="listaprodutos.php">Lista de Produtos</a></li>
        <li><a href="listausuario.php">Lista de Usuarios</a></li>
    </nav>

    <div>
        <form action="alterausuario.php" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>NOME</label>
            <input type="text" name="nome" value="<?= $nome ?>" required>
            <label>SENHA</label>
            <input type="password" name="senha" value="<?= $id ?>" required>
            <p></p>
            <label>STATUS: <?= $check = ($ativo == 's') ? "ATIVO" : "INATIVO"?></label>
            <p></p>
            <input type="radio" name="ativo" value="s"
            <?$ativo == "s" ? "checked" : ""?>>ATIVO<br>
            <input type="radio" name="ativo" value="n"
            <?$ativo =="n" ? "checked" : ""?>>INATIVO<br>

            <input type="submit" value="SALVAR">
        </form>
    </div>
</body>
</html>