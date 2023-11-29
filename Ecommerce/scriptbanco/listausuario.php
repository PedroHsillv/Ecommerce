<?php
#ABRE UMA CONEXÃO COM O BANCO DE DADOS
include("cabecalho.php");

#PASSANDO UMA INSTRUÇÃO AO BANCO DE DADOS
$sql = "SELECT * FROM usuarios WHERE usu_ativo = 's'";
$retorno = mysqli_query($link, $sql);

#FORÇA SEMPRE TRAZER O 'S' NA VÁRIAVEL PARA UTILIZARMOS NOS RADIOS BUTTON
$ativo = "s";

#COLETA O BOTÃO MÉTODO POST VINDO DO HTML
    if($_SERVER ['REQUEST_METHOD'] == 'POST'){
        $ativo = $_POST['ativo'];

        #VERIFICA SE O USUARIO ESTÁ ATIVO PARA LISTAR SE 'S' LISTA SENÃO NÃO LISTA
        if($ativo == 's') {
            $sql = "SELECT * FROM usuarios WHERE usu_ativo = 's'";
            $retorno = mysqli_query($link, $sql);
        } else {
            $sql = "SELECT * FROM usuarios WHERE usu_ativo = 'n'";
            $retorno = mysqli_query($link, $sql);
        }
    }
  

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LISTA DE USUARIO</title>
    <link rel="stylesheet" href="./css/estiloadm4.css">
</head>

<body>
    <div id="background">
        <form action="listausuario.php" method="post">
            <input type="radio" name="ativo" class="radio" value="s" required onclick="submit()" <?= $ativo == "s" ? "checked" : "" ?>>ATIVOS
            <br>
            <input type="radio" name="ativo" class="radio" value="n" required onclick="submit()" <?= $ativo == "n" ? "checked" : "" ?>>INATIVOS
        </form>
        <div class="container">
            <table border="1">
                <tr>
                    <th>NOME</th>
                    <th>ALTERAR DADOS</th>
                    <th>ATIVO</th>
                </tr>
                <?php
                while ($tbl = mysqli_fetch_array($retorno)) {
                    #MAS AQUI EU FECHO PARA TRABALHAR COM HTML SIMULTANEAMENTE
                ?>
                    <tr>
                        <td><?= $tbl[1] ?></td> <!--TRAS SOMENTE A COLUNA 1 [NOME]~DO BANCO DE DADOS -->

                        <td><a href="alterausuario.php?id=<?= $tbl[0] ?>"><input type="button" value="ALTERAR DADOS"> </a> </td>
                        <td><?= $check = ($tbl[3] == "s") ? "SIM" : "NÃO" ?></td>


                    </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>
</html>