<?php
include("cabecalho.php");

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];
    $ativo = $_POST['ativo'];

    // Verifica se o produto já está cadastrado no banco de dados
    $verificaProduto = "SELECT * FROM produtos WHERE pro_nome = '$nome'";
    $resultado = mysqli_query($link, $verificaProduto);

    // Se o produto já existe, exibe uma mensagem de erro
    if (mysqli_num_rows($resultado) > 0) {
        echo "<script>window.alert('Produto já cadastrado. Por favor, escolha um nome diferente.');</script>";
    } else {
        // Obtém o nome do arquivo de imagem e o caminho temporário do arquivo
        $imagemNome = $_FILES['imagem']['name'];
        $imagemTemp = $_FILES['imagem']['tmp_name'];

        // Converte a imagem para base64
        $imagemBase64 = base64_encode(file_get_contents($imagemTemp));
        $imagemBase64 = 'data:image/' . pathinfo($imagemNome, PATHINFO_EXTENSION) . ';base64,' . $imagemBase64;

        // Insere os dados no banco de dados, incluindo a imagem em base64
        $sql = "INSERT INTO produtos (pro_nome, pro_descr, pro_quant, pro_valor, pro_ativo, pro_imagem) 
                VALUES ('$nome', '$descricao', '$quantidade', '$valor', '$ativo', '$imagemBase64')";

        $retorno = mysqli_query($link, $sql);

        // Verifica se a inserção foi bem-sucedida
        if ($retorno) {
            echo "<script>window.alert('PRODUTO CADASTRADO!');</script>";
        } else {
            echo "Erro ao inserir dados: " . mysqli_error($link);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./css/estiloadm4.css">
    <title>Cadastro de Produtos</title>
</head>

<body>

    <div class="text">
        <h1 align=center>Cadastro de Produtos</h1>
    </div>
    <form method="post" enctype="multipart/form-data">
        Nome: <input type="text" name="nome" required><br>
        Descrição: <textarea name="descricao"></textarea><br>
        Quantidade: <input type="number" name="quantidade" required><br>
        Valor: <input type="number" name="valor" step="0.01" required><br>
        Imagem: <input type="file" name="imagem" required><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>

</html>

