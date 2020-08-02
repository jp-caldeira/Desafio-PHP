<?php

include 'removerUsuario.php';

if (isset($_SESSION['msgRemove'])){
  echo $_SESSION['msgRemove'];
  unset($_SESSION['msgRemove']);
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
  </head>
  <body>
      <h1>Lista de usuários cadastrados</h1>
      <?php  if ($arrayClientes){
            foreach($arrayClientes as $cliente){ ?>
        <div class="">
              <p><strong>Nome do usuário:</strong><?=$cliente["nome"]?></p>
              <p><strong>Email:</strong><?=$cliente["email"]?></p>
              <form class="" action="removerUsuario.php" method="post">
              <button type="submit" name="remover" value="<?=$cliente["email"]?>">Remover Cliente</button>
              <button type="submit" name="editar"  value="<?=$cliente["email"]?>">Editar Cliente</button>
              </form>
    </div>
<?php   }
} else { ?>
    <p>Nada para exibir.</p>
    <p>Vá para a página de <a href='createUsuario.php'>cadastro de usuários</a></p>
<?php } ?>

  </body>
</html>
