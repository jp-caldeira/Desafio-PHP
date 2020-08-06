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
  </head>
  <body>
    <h1>Cadastrar novo usuário</h1>
      <!-- exibindo mensagem de sucesso ou erro no cadastro -->
     <?php if(isset($_SESSION['msgCadastroUser'])){
              $ultimoItem = array_key_last($arrayClientes);
              if ($_SESSION['msgCadastroUser']){ ?>
              <div style='background-color:lightgreen'>
              <br><p>Cadastro realizado com sucesso! Confira as informações abaixo:</p>
                  <p>Nome:<?=$arrayClientes[$ultimoItem]['nome']?></p>
                  <p>Email:<?=$arrayClientes[$ultimoItem]['email']?></p>                                                      
              </div>
            <?php unset($_SESSION['msgCadastroUser']);
                } else { ?>
                <div style='background-color:red'>
                  <p>Usuário não foi cadastrado. Revise as informações e tente novamente. Por favor, verifique os erros abaixo:</p>
                </div>
                <?php unset($_SESSION['msgCadastroUser']); }
                    } ?>
        

      <p>Preencha as informações abaixo para cadastrar um novo usuário:</p>
          <form class="" action="newUser.php" method="post">
             <!-- nome do usuario    -->
          <label for="nomeUsuario">Nome:</label><br>
                <?php if (isset($_SESSION['errUserName'])){ ?>
                  <input type="text" name="nomeUsuario" style="background-color:yellow" value=""><br>
                     <?php echo $_SESSION['errUserName'];
                        unset($_SESSION['errUserName']); ?> 
                      <?php } else { ?>                      
                      <input type="text" name="nomeUsuario" value=""><br>    
                      <?php } ?>
                <!-- email -->
                <label for="emailUsuario">Email:</label><br>
                <?php if (isset($_SESSION['errUserEmail'])){?>
                    <input type="email" name="emailUsuario" style='background-color:yellow' value=""><br>
                    <?php echo $_SESSION['errUserEmail'];
                        unset($_SESSION['errUserEmail']);
                      } else { ?>
                    <input type="email" name="emailUsuario" value=""><br>   
                    <?php } ?>
                        <!-- senha -->
                <label for="senha">Senha:</label><br>
                <?php if (isset($_SESSION['errNewSenha1'])){?>
                    <input type="password" name="senhaUsuario" style='background-color:yellow' value=""><br>
                    <?php echo $_SESSION['errNewSenha1'];
                        unset($_SESSION['errNewSenha1']);
                      } else { ?>
                    <input type="password" name="senhaUsuario" value=""><br>
                    <?php } ?>
                        <!-- confirma senha -->
                <label for="senha">Confirme a senha:</label><br>
                <?php if (isset($_SESSION['errNewSenha2'])){?>
                    <input type="password" name="confirmaSenha" style='background-color:yellow' value=""><br>
                    <?php echo $_SESSION['errNewSenha2'];
                        unset($_SESSION['errNewSenha2']);
                      } else { ?>
                  <input type="password" name="confirmaSenha" value=""><br>
                    <?php } ?>
                  <button type="submit" name="button">Enviar</button>
          </form>
<?php
if(isset($_SESSION['usuariologado'])): ?>
    <form class="" action="login.php" method="post">
      <button type="submit" name="logoff">Sair do sistema</button>
    </form>
<?php endif;

echo "<br><br>";
include 'indexUsuarios.php';

 ?>



  </body>
</html>
