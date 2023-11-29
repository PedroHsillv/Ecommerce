<?php
include("cabecalho.php");
$sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
$retorno = mysqli_query($link, $sql);
$ativo = "s"; // Valor padrão: ativos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ativo = $_POST['ativo'];
    // Atualiza o status de ativo conforme a quantidade do produto
    if ($ativo == "all") {
        $sql = "SELECT * FROM produtos";
    } elseif ($ativo == 's') {
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 's'";
    } else {
        $sql = "SELECT * FROM produtos WHERE pro_ativo = 'n'";
    }  
    $retorno = mysqli_query($link, $sql);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="./css/estiloadm4.css">
</head>

<body>
    <div id="background">
        <form action="listaprodutos.php" method="post">
            <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()" <?= $ativo == "s" ? "checked" : "" ?>>Ativos
            <br>
            <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()" <?= $ativo == "n" ? "checked" : "" ?>>Inativos
            <br>
            <input type="radio" name="ativo" class="radio" value="all" required onclick="submit()" <?= $ativo == "all"? "checked" : "" ?>>Mostrar Todos
        </form>
        <div class="container">
            <table border="1">
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Imagem</th>
                    <th>Alterar Dados</th>
                    <th>Ativo</th>
                </tr>
                
                 <?php
if (mysqli_num_rows($retorno) > 0) {
    while ($tbl = mysqli_fetch_array($retorno)) {
?>
        <tr>
            <td><?= $tbl['pro_nome'] ?></td>
            <td><?= $tbl['pro_descr'] ?></td>
            <td><?= $tbl['pro_quant'] ?></td>
            <td>R$: <?= $tbl['pro_valor'] ?></td>
            <td><img src="<?= $tbl['pro_imagem'] ?>" alt="Imagem do Produto" width="150"></td>
            <td><a href="alteraprodutos.php?id=<?= $tbl[0] ?>"><input type="button" value="ALTERAR DADOS"> </a> </td>
            <td><?= $tbl['pro_ativo'] == 's' ? 'Sim' : 'Não' ?></td>
        </tr>
<?php
    }
} else {
    echo "<tr><td colspan='5'>Nenhum produto encontrado.</td></tr>";
}
?>

            </table>
        </div>
    </div>
</body>
</html>