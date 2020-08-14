<?php

session_start();

if(!isset($_SESSION['usuariologado'])){
    header('Location:assets/acess-denied.html');
    die();
}

if(!$_GET){
  $_SESSION['msgEditUser'] = "Escolha um usuário para editar";
  header('Location:indexUsuarios.php');
  die();
   }

   $arrayUsuarios = file_get_contents('assets/json/usuarios.json');
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>
    <?php include 'assets/navbar.php' ?>
    <div class="container conteudo text-center mb-4">
      <h1 class="display-4 p-3">Editar Usuário</h1>
          <p><strong>Nome: </strong><?=$arrayUsuarios[$user]['nome'] ?></p>
          <p><strong>Email: </strong><?=$arrayUsuarios[$user]['email']?></p>
      <h4 class="alert alert-info mt-4">Editar informações:</h4>
      <?php if (isset($_SESSION['msgCadastro'])){
      if ($_SESSION['msgCadastro']){?>
      <div class='alert alert-success'>Informações atualizadas com sucesso!</div>
      <?php unset($_SESSION['msgCadastro']);
            } else { ?>
      <div class="alert alert-danger">As informações não foram atualizadas. Confira os erros abaixo:</div>
      <?php unset($_SESSION['msgCadastro']); }
            } ?>


      <form class="form-group p-2" action="assets/edit/userEdit.php" method="post">
             <div class="form-row">
                <div class="col-1 offset-4">
                    <label for="nomeUsuario">Nome:</label>
                </div>
                <div class="col-3">
                    <?php if (isset($_SESSION['erroNome'])){ ?>
                      <input type="text" name="nomeUsuario" class="form-control form-control-sm is-invalid" value="<?=$arrayUsuarios[$user]['nome']?>" required>
                      <div class="invalid-feedback">
                      <?php echo $_SESSION['erroNome'];
                      unset($_SESSION['erroNome']); ?>
                      </div><br>
                      <?php } else { ?>
                        <input type="text" class="form-control form-control-sm" name="nomeUsuario" value="<?=$arrayUsuarios[$user]['nome']?>" required><br>
                  <?php } ?>
                </div>
            </div>
            <!-- email -->
      <div class="form-row">
          <div class="col-1 offset-4">
            <label for="emailUsuario">Email:</label><br>
          </div>
          <div class="col-3">
            <?php if (isset($_SESSION['erroEmail'])){?>
                <input type="email" name="emailUsuario" class="form-control form-control-sm is-invalid" value="<?=$arrayUsuarios[$user]['email']?>" required>
                <div class="invalid-feedback">
                <?php echo $_SESSION['erroEmail'];
                    unset($_SESSION['erroEmail']); ?>
                </div><br>
              <?php  } else { ?>
                <input type="email" class="form-control form-control-sm" name="emailUsuario" value="<?=$arrayUsuarios[$user]['email']?>" required><br>
                <?php } ?>
              </div>
            </div>
                    <!-- senha -->
        <div class="form-row">
          <div class="col-2 offset-3">
              <label for="senha">Nova senha:</label><br>
            </div>
            <div class="col-3">
            <?php if (isset($_SESSION['erroSenha'])){?>
                <input type="password" name="senhaUsuario" class="form-control form-control-sm is-invalid" value="<?=$arrayUsuarios[$user]['senha']?>" required>
                <div class="invalid-feedback">
                    <?php echo $_SESSION['erroSenha'];
                    unset($_SESSION['erroSenha']); ?>
                </div><br>
                  <?php } else { ?>
                <input type="password" name="senhaUsuario" class="form-control form-control-sm" value="<?=$arrayUsuarios[$user]['senha']?>" required><br>
                <?php } ?>
              </div>
            </div>
                    <!-- confirma senha -->
          <div class="form-row">
            <div class="col-2 offset-3">
              <label for="senha">Confirme a nova senha:</label><br>
            </div>
            <div class="col-3">
            <?php if (isset($_SESSION['erroSenha'])){?>
                <input type="password" name="confirmaSenha" class="form-control form-control-sm is-invalid" value="<?=$arrayUsuarios[$user]['senha']?>" required>
                <div class="invalid-feedback">
                <?php echo $_SESSION['erroSenha'];
                    unset($_SESSION['erroSenha']); ?>
                  </div><br>
                <?php  } else { ?>
              <input type="password" class="form-control form-control-sm" name="confirmaSenha" value="<?=$arrayUsuarios[$user]['senha']?>" required><br>
                <?php } ?>
              </div>
            </div>
              <button type="submit" class="btn btn-primary" name="button">Enviar</button>
      </form>
          <form class="" action="assets/remove/removerUsuario.php" method="post">
          <button type="submit" class="btn btn-secondary" name="remover" value="<?=$user?>">Remover Cliente</button>
    </div>





<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
