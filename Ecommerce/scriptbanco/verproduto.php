<?php
include("cabecalho2.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nomeproduto = $_POST['nomeproduto'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $quantidade = (int)$quantidade;
    $preco = $_POST['preco'];
    $preco = (float)$preco;
    $totalitem = $_POST['preco'];
    $numerocarrinho = ($idusuario . RAID());

    if ($idusuario <= 0){
        echo "<script>window.alert('VOCE PRECISA FAZER LOGIN PARA ADICIONAR ALGUM ITEM AO CARRINHO!);</script>";
        echo "<script>window.location.href='loja.php';</script>";
    }else{
        $sql = "SELECT COUNT(car_id) FROM carrinho INNER JOIN clientes ON fk_cli_id = cli_id = $idusuario AND car_finalizado = 'n'";

        $retorno = mysqli_query($link,$sql);
        while($tbl = mysqli_fetch_array($retorno)){
            $cont = $tbl [0];

                if($cont == 0){
                    $valor_venda = $quantidade = $preco;

                    $sql = "SELECT car_id FROM carrinho WHERE fk_cli_id '$idusuario' AND car_finalizado = 'n'";
                    $retorno = mysqli_query($link,$sql);
                    
                    while ($tbl = mysqli_fetch_array($retorno)) {

                        $numerocarrinhocliente = $tbl[0];
                        $_SESSION['carrinhoid'] = $numerocarrinhocliente;
                    }
                }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/loja3.css">
    <title>Document</title>
</head>
<body>
<div class="formulario">
        <form class="visualizaproduto" action="verproduto.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>" readonly>
            <label>NOME</label>
            <input type="text" name="nomeproduto" id="nome" value="<?= $nomeproduto ?>" readonly>
            <label>DESCRIÇÃO</label>
            <textarea name="descricao" readonly <?= $descricao ?>></textarea>
            <label>QUANTIDADE</label>
            <input type="number" name="quantidade" id="quantidade" min="1" value="1">
            <label>PREÇO</label>
            <input type="decimal" name="preco" id="preco" value="R$ <?= $preco ?>" readonly>
            <input type="submit" value="ADICIONAR AO CARRINHO">
 
        </form>
    </div>
    <div style="position: relative;">
    <a href="favoritar.php?id=<?= $id ?>" style="position: absolute; top: 0; left: 0;">
</a>
    <td><img name="imagem_atual" class="imagem_atual" src="imagens,<?= $imagem_atual ?>"></td>
</div>
</body>
</html>