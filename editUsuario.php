<?php

session_start();

if(!isset($_SESSION['usuariologado'])){
    header('Location:acess-denied.html');
    die();
}

if(!$_GET){
  $_SESSION['msgEditUser'] = "Escolha um usuário para editar";
  header('Location:indexUsuarios.php');
  die();
   }

   $arrayUsuarios = file_get_contents('usuarios.json');
   $arrayUsuarios = json_decode($arrayUsuarios, true);

if(isset($_GET['usuario'])){
  $user = $_GET['usuario'];

  foreach($arrayUsuarios as $usuario){
      $newEmail = $usuario['email'];
      $emails[] = $newEmail;
  }

if(!in_array($user, $emails)){
  $_SESSION['msgEditUser'] = "Escolha um usuário para editar";
  header('Location:indexUsuarios.php');
  die();
}

}



$_SESSION['currentName'] = $arrayUsuarios[$user]['nome'];
$_SESSION['currentEmail'] = $arrayUsuarios[$user]['email'];
$_SESSION['currentPass'] = $arrayUsuarios[$user]['senha'];


?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name='viewport' content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
  </head>
  <body>
    <h1>Editar Usuário</h1>
      <div class="">
        <ul>
          <li>Nome: <?=$arrayUsuarios[$user]['nome'] ?></li>
          <li>Email: <?=$arrayUsuarios[$user]['email']?></li>
        </ul>
      </div>
      <p>Editar informações:</p>
        <?php if (isset($_SESSION['msgCadastro'])): echo $_SESSION['msgCadastro']; unset($_SESSION['msgCadastro']); else: ""; endif;?>
            <form class="" action="userEdit.php" method="post">
                <label for="nomeUsuario">Nome:</label><br>
                    <input type="text" name="nomeUsuario" value="<?=$arrayUsuarios[$user]['nome']?>" required><br>
                  <?php if (isset($_SESSION['erroNome'])): echo $_SESSION['erroNome']; unset($_SESSION['erroNome']); else: ""; endif;?>
                <label for="emailUsuario">Email:</label><br>
                    <input type="email" name="emailUsuario" value="<?=$arrayUsuarios[$user]['email']?>"><br>
                <?php if (isset($_SESSION['erroEmail'])): echo $_SESSION['erroEmail']; unset($_SESSION['erroEmail']); else: ""; endif;?>
                <label for="senha">Nova senha:</label><br>
                    <input type="password" name="senhaUsuario" value="<?=$arrayUsuarios[$user]['senha']?>"><br>
                <label for="senha">Confirme a nova senha:</label><br>
                  <input type="password" name="confirmaSenha" value="<?=$arrayUsuarios[$user]['senha']?>"><br>
                  <?php if (isset($_SESSION['erroSenha'])): echo $_SESSION['erroSenha']; unset($_SESSION['erroSenha']); else: ""; endif;?>
                  <button type="submit" name="button">Enviar</button>
              </form>
              <form class="" action="removerUsuario.php" method="post">
                  <button type="submit" name="remover" value="<?=$user?>">Remover Cliente</button>
              </form>
  </body>
</html>
