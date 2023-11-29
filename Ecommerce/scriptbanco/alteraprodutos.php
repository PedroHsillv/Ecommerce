<?php
# INICIA A CONEXÃO COM O BANCO DE DADOS
include("cabecalho.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao']; 
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];
    $ativo = $_POST['ativo'];
    $imagem = $_POST['imagem'];

    if ($_FILES['imagem']['tmp_name']) {
        $img_name = $_FILES['imagem']['name'];
        $destino = '' . $img_name;

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
            $sql = "UPDATE produtos SET pro_nome = '$nome', pro_descr = '$descricao', pro_quant = '$quantidade', pro_valor = '$valor', pro_ativo = '$ativo', pro_imagem = '$img_name' WHERE pro_id = $id";
            mysqli_query($link, $sql);
        }
    } else {
        $sql = "UPDATE produtos SET pro_nome = '$nome', pro_descr = '$descricao', pro_quant = '$quantidade', pro_valor = '$valor', pro_ativo = '$ativo' WHERE pro_id = $id";
        mysqli_query($link, $sql);
    }

    echo "<script>window.alert('PRODUTO ALTERADO COM SUCESSO!');</script>";
    echo "<script>window.location.href='listaprodutos.php';</script>";
    exit();
}

# COLETANDO OS DADOS PASSADOS VIA GET
$id = $_GET['id'];
$sql = "SELECT * FROM produtos WHERE pro_id = '$id'";
$retorno = mysqli_query($link, $sql);

while ($tbl = mysqli_fetch_array($retorno)) {
    $nome = $tbl[1];
    $descricao = $tbl[2];
    $quantidade = $tbl[3];
    $valor = $tbl[4];
    $ativo = $tbl[5];
    $imagem = $tbl[6];
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm4.css">
    <title>altera produto</title>
</head>
<body>
    <div>
        <form action="alteraprodutos.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            <label>NOME:</label>
            <input type="text" name="nome" value="<?= $nome ?>" required>
            <label>VALOR:</label>
            <input type="text" name="valor" value="<?= $valor ?>" required>
            <p></p>
            <label>Descrição:</label>
            <input type="text" name="descricao" value="<?= $descricao ?>" required>
            <p></p>
            <label>Quantidade:</label>
            <input type="text" name="quantidade" value="<?= $quantidade ?>" required>
            <p></p>
            <input type="radio" name="ativo" value="n" <?= $ativo == "n" ? "checked" : "" ?>>INATIVO<br>
            <input type="radio" name="ativo" value="s" <?= $ativo == "s" ? "checked" : "" ?>>ATIVO<br>
            <br>
            <input type="file" name="imagem">
            <br>
            <input type="submit" value="SALVAR">
           
        </form>
       <img src="<?= $tbl['pro_imagem'] ?>">
    </div>
</body>
</html>