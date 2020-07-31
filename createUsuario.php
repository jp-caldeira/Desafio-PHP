<?php
//campos:
//nome
//email
//senha
//confirmação de senha

//nome e email são obrigatórios
//senha deve ter pelo menos 6 caracteres
//senha e confirmação devem ser iguais
//senha criptografada
session_start();

var_dump($_POST);

$senhaValid1 = true;
$senhaValid2 = true;
$nomeOK = true;
$emailOK = true;
$senhaOK = true;


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
      echo "<br><br>nome inválido<br>";
      $nomeOK = false;
    } else {
      echo "<br><br>nome OK<br>";
    }
  //validando email
  if(empty($email)) {
    echo "<br>email inválido<br>";
    $emailOK = false;
  } else {
    echo "<br>email OK<br>";
  }
  //validando senha
  if(strlen($senha1) < 6){
        echo "<br>senha deve ter pelo menos seis caracteres<br>";
        $senhaValid1 = false;
      } else {
        echo "<br>senha ok<br>";
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
        echo "<h4>Há algo de errado com a senha. Ou ela tem menos de seis caracteres ou as senhas não são iguais</h4>";
        $senhaOK = false;
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
