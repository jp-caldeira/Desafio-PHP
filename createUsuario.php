<?php

session_start();

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
      <title>Cadastro de usuários</title>
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
      <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include "navbar.php" ?>
    <div class="container conteudo text-center">
        <h1 class="display-4 p-3">Cadastrar novo usuário</h1>
      <!-- exibindo mensagem de sucesso ou erro no cadastro -->
        <?php if(isset($_SESSION['msgCadastroUser'])){
              $ultimoItem = array_key_last($arrayClientes);
              if ($_SESSION['msgCadastroUser']){ ?>
              <div class="alert alert-success">Cadastro realizado com sucesso! Confira as informações abaixo:</br>
                  <strong>Nome: </strong><?=$arrayClientes[$ultimoItem]['nome']?><br>
                  <strong>Email: </strong><?=$arrayClientes[$ultimoItem]['email']?>
              </div>
            <?php unset($_SESSION['msgCadastroUser']);
                } else { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <p>Usuário não foi cadastrado. Revise as informações e tente novamente. Por favor, verifique os erros abaixo:</p>
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                </div>
                <?php unset($_SESSION['msgCadastroUser']); }
                    } ?>



  <h5 class="mb-4">Preencha as informações abaixo para cadastrar um novo usuário:</h5>
          <form class="form-group p-2" action="newUser.php" method="post">
             <!-- nome do usuario    -->
             <div class="form-row">
                    <div class="col-1 offset-4">
                        <label for="nomeUsuario">Nome:</label>
                    </div>
                    <div class="col-3">
                        <?php if (isset($_SESSION['errUserName'])){ ?>
                          <input type="text" name="nomeUsuario" class="form-control form-control-sm is-invalid" value="" required>
                          <div class="invalid-feedback">
                          <?php echo $_SESSION['errUserName'];
                          unset($_SESSION['errUserName']); ?>
                        </div><br>
                          <?php } else { ?>
                            <input type="text" class="form-control form-control-sm" name="nomeUsuario" value="" required><br>
                      <?php } ?>
                    </div>
                  </div>
                <!-- email -->
          <div class="form-row">
              <div class="col-1 offset-4">
                <label for="emailUsuario">Email:</label><br>
              </div>
              <div class="col-3">
                <?php if (isset($_SESSION['errUserEmail'])){?>
                    <input type="email" name="emailUsuario" class="form-control form-control-sm is-invalid" value="" required>
                    <div class="invalid-feedback">
                    <?php echo $_SESSION['errUserEmail'];
                        unset($_SESSION['errUserEmail']); ?>
                    </div><br>
                  <?php  } else { ?>
                    <input type="email" class="form-control form-control-sm" name="emailUsuario" value="" required><br>
                    <?php } ?>
                  </div>
                </div>
                        <!-- senha -->
            <div class="form-row">
              <div class="col-1 offset-4">
                  <label for="senha">Senha:</label><br>
                </div>
                <div class="col-3">
                <?php if (isset($_SESSION['errNewSenha1'])){?>
                    <input type="password" name="senhaUsuario" class="form-control form-control-sm is-invalid" value="" required>
                    <div class="invalid-feedback">
                        <?php echo $_SESSION['errNewSenha1'];
                        unset($_SESSION['errNewSenha1']); ?>
                    </div><br>
                      <?php } else { ?>
                    <input type="password" name="senhaUsuario" class="form-control form-control-sm" value="" required><br>
                    <?php } ?>
                  </div>
                </div>
                        <!-- confirma senha -->
              <div class="form-row">
                <div class="col-2 offset-3">
                  <label for="senha">Confirme a senha:</label><br>
                </div>
                <div class="col-3">
                <?php if (isset($_SESSION['errNewSenha2'])){?>
                    <input type="password" name="confirmaSenha" class="form-control form-control-sm is-invalid" value="" required>
                    <div class="invalid-feedback">
                    <?php echo $_SESSION['errNewSenha2'];
                        unset($_SESSION['errNewSenha2']); ?>
                      </div><br>
                    <?php  } else { ?>
                  <input type="password" class="form-control form-control-sm" name="confirmaSenha" value="" required><br>
                    <?php } ?>
                  </div>
                </div>
                  <button type="submit" class="btn btn-primary" name="button">Enviar</button>
          </form>
      </div>
<?php  include 'indexUsuarios.php';

         ?>


 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

  </body>
</html>
