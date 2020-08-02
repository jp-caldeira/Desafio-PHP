<?php

session_start();

$senhaValid1 = true;
$senhaValid2 = true;
$nomeOK = true;
$emailOK = true;
$senhaOK = true;

$arrayClientes = file_get_contents('usuarios.json');
$arrayClientes = json_decode($arrayClientes, true);

if($arrayClientes){
      foreach ($arrayClientes as $clientes){
          $newEmail = $clientes["email"];
          $arrayEmails[] = $newEmail;
      }
}

//validações
if($_POST){
  $nomeUsuario = $_POST['nomeUsuario'];
  $nomeUsuario = trim($nomeUsuario);
  $email = $_POST['emailUsuario'];
  $email = trim($email);
  $senha1 = $_POST['senhaUsuario'];
  $senha1 = trim($senha1);
  $senha2 = $_POST['confirmaSenha'];
  $senha2 = trim($senha2);
    //validando nome
    if(empty($nomeUsuario) || strlen($nomeUsuario) < 5) {
      echo "Nome inválido<br>";
      $nomeOK = false;
    } else {
      echo "Nome OK<br>";
    }
  //validando email
  if(empty($email)) {
    echo "email inválido<br>";
    $emailOK = false;
  } else {
    echo "email OK<br>";
  }

  if($arrayClientes){
    if (in_array($email, $arrayEmails)){
    echo "Email já cadastrado no sistema.<br>";
    $emailOK = false;
  }
}
  //validando senha
  if(strlen($senha1) < 6){
        echo "senha deve ter pelo menos seis caracteres<br>";
        $senhaValid1 = false;
      } else {
        echo "Senha ok<br>";
      }

      if ($senha1 === $senha2){
        echo "as duas senhas são iguais<br>";
      } else {
        echo "as senhas não são iguais<br>";
        $senhaValid2 = false;
      }

      //validando e criptografando
    if ($senhaValid1 && $senhaValid2){
        echo "as senhas são iguais e tem mais de seis caracteres<br>";
        $criptoSenha = password_hash($senha1, PASSWORD_DEFAULT);
      } else {
        echo "Há algo de errado com a senha. Ou ela tem menos de seis caracteres ou as senhas não são iguais<br>";
        $senhaOK = false;
      }
//salvando no json

    if($nomeOK && $emailOK && $senhaOK){
        $arrayinsert = ["nome" => $nomeUsuario, "email" => $email, "senha" => $criptoSenha];
        $arrayClientes[$email] = $arrayinsert;
        $arrayClientes = json_encode($arrayClientes);
        file_put_contents('usuarios.json', $arrayClientes);
        echo "<strong>Usuário cadastrado com sucesso</strong><br>";
      } else {
        echo "Usuário não foi cadastrado.<br>";
      }
}

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
      <p>Preencha as informações abaixo para cadastrar um novo usuário:</p>
          <form class="" action="createUsuario.php" method="post">
                <label for="nomeUsuario">Nome:</label><br>
                    <input type="text" name="nomeUsuario" value=""><br>
                <label for="emailUsuario">Email:</label><br>
                    <input type="email" name="emailUsuario" value=""><br>
                <label for="senha">Senha:</label><br>
                    <input type="password" name="senhaUsuario" value=""><br>
                <label for="senha">Confirme a senha:</label><br>
                  <input type="password" name="confirmaSenha" value=""><br>
                  <button type="submit" name="button">Enviar</button>
          </form>
  </body>
</html>
