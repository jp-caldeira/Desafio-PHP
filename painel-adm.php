<?php
session_start();
if(!isset($_SESSION['usuariologado'])){
    header('Location:acess-denied.html');
    die();
}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name='viewport' content="width=device-width, initial-scale=1.0">
    <title>Painel administrativo</title>
  </head>
  <body>
    <h1>Painel administrativo</h1>
    <ul>
    <li><a href="indexProdutos.php">Lista de Produtos</a></li>
    <li><a href="indexUsuarios.php">Lista de Usuários</a></li>
    <li><a href="createProduto.php">Cadastrar produto</a></li>
    <li><a href="createUsuario.php">Cadastrar usuário</a></li>
</ul>
    <form class="" action="login.php" method="post">
      <button type="submit" name="logoff">Sair do sistema</button>
    </form>

  </body>
</html>
