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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="container conteudo text-center">
      <h1 class="display-4 p-3">Painel administrativo</h1>
        <ul class="list-group">
            <li class="list-group-item list-group-item-action"><a href="indexProdutos.php">Lista de Produtos</a></li>
            <li class="list-group-item list-group-item-action"><a href="indexUsuarios.php">Lista de Usuários</a></li>
            <li class="list-group-item list-group-item-action"><a href="createProduto.php">Cadastrar produto</a></li>
            <li class="list-group-item list-group-item-action"><a href="createUsuario.php">Cadastrar usuário</a></li>
        </ul>
<br>
    <form class="" action="login.php" method="post">
      <button type="submit" class="btn btn-warning" name="logoff">Sair do sistema</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
