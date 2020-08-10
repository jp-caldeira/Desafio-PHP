<?php

  if(!isset($_SESSION)){
    session_start();
  }

if(!isset($_SESSION['usuariologado'])){
     header('Location:acess-denied.html');
     die();
 }

$arrayClientes = file_get_contents('usuarios.json');
$arrayClientes = json_decode($arrayClientes, true);

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name='viewport' content="width=device-width, initial-scale=1.0">
    <title>Lista de usuários cadastrados</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
 <?php include_once 'navbar.php';

 if (isset($_SESSION['msgRemove'])){
  echo "<div class='alert alert-warning' role='alert'>$_SESSION[msgRemove]</div>";
  unset($_SESSION['msgRemove']);
}

if(isset($_SESSION['msgEditUser'])){
    echo "<div class='alert alert-warning' role='alert'>$_SESSION[msgEditUser]</div>";
    unset($_SESSION['msgEditUser']);
}

?>
<div class="container conteudo mb-4">
      <h1 class="display-4 p-3 text-center">Lista de usuários cadastrados</h1>
      <?php  if ($arrayClientes){ ?>
        <table class="table table-bordered table-hover">
          <thead class="thead-dark text-center">
            <tr>
              <th scope="col">Nome</th>
              <th scope="col">Email</th>
              <th scope="col"></th>
              <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
        <?php   foreach($arrayClientes as $cliente){ ?>
          <tr>
              <td><?=$cliente["nome"]?></td>
              <td><?=$cliente["email"]?></td>
              <td class="text-center"><a type="button" class="btn btn-primary btn-sm" href="editUsuario.php?usuario=<?=$cliente["email"]?>">Editar</a></td>
              <form class="" action="removerUsuario.php" method="post">
              <td class="text-center"><button type="submit"  class="btn btn-secondary btn-sm" name="remover" value="<?=$cliente["email"]?>">Remover</button></td>
              </form>
          </tr>
    </div>
<?php   }
} else {
    header('Location:createUsuario.php');
 } ?>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
