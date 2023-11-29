<?php
    include("conectadb.php");
    session_start();
    if (isset($_SESSION['nomeusuario'])) {
        $nomeusuario = $_SESSION['nomeusuario'];
        $idusuario = $_SESSION['idusuario'];
    } else {
        $nomeusuario = "";
    }
?>
 
 
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/estiloadm4.css">
    <title>Cabecalho</title>
</head>
<body>
    <div class="menu">
   <li><a href="loja.php">HOME</a></li>
 
   <?php
   if ($nomeusuario != "") {
    ?>
    <li class="profile"><a href="logout.php">SAIR</a></li>
     <li class="profile"><a href="perfil.php?id=<?= ($idusuario) ?>">OLÁ <?= strtoupper($nomeusuario)?></a></li>
     <li class="profile"><a class="menuloja" href="carrinho.php?id= <?= ($idusuario) ?>">CARRINHO</a></li>
 
 
     <?php
   } else {
    ?>
    <li class="profile"><a class="profile" href="logincliente.php">LOGIN</a></li>
    <?php
   }
   ?>
</div>
</body>
</html>