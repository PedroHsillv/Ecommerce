<?php
include("conectadb.php");
session_start();
isset($_SESSION['nomeusuario'])?$nomeusuario = $_SESSION['nomeusuario']: "";
$nomeusuario = $_SESSION['nomeusuario'];


?>

<div>

<ul class="menu">

            <li><a href="cadastrausuario.php">CADASTRA USUÁRIO</a></li>
            <li><a href="login.php">LOGIN USUARIO</a></li>
            <li><a href="cadastraprodutos.php">CADASTRA PRODUTOS</a></li>
            <li><a href="listausuario.php">LISTA USUÁRIO</a></li>
            <li><a href="listaprodutos.php">LISTA PRODUTO</a></li>
            <li><a href="loja.php">LOJA</a></li>
            <li><a href="cadastracliente.php">CLIENTE</a></li>
            <li><a href="loginclientes.php">LOGIN COMPRA</a></li>
            <!--<li><a href="listaclientes.php">LISTAR CLIENTES</a></li>
            <li><a href="vendas.php">VENDAS</a></li>-->
            <li class="menuloja"><a href="logout.php">SAIR</a></li>

            <?php
                if($nomeusuario != null) {
                ?>
                    <li class="profile"> OLÁ  <?= strtoupper($nomeusuario) ?></li>
                    <?php
                } else {
                    ?>
                    <li class="profile"> OLÁ  <?= strtoupper($nomeusuario) ?></li>
                    <?php
                    echo "<script>window.alert('USUÁRIO NÃO AUTENTICADO'); window.location.href='login.php';</script>"; 
                }
                ?>
            
</ul>
</div>