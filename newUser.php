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
    if(empty($nomeUsuario) || strlen($nomeUsuario) < 2) {
      $_SESSION['errUserName'] = "O campo nome deve ter pelo menos três caracteres.<br>";
      $nomeOK = false;
    }

  //validando email
  if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['errUserEmail'] = "Email inválido<br>";
    $emailOK = false;
  } 

  if($arrayClientes){
    if (in_array($email, $arrayEmails)){
        $_SESSION['errUserEmail'] = "Email já cadastrado no sistema<br>";
    $emailOK = false;
  }
}
  //validando senha
  if(strlen($senha1) < 6){
    $_SESSION['errNewSenha1'] = "Senha deve ter pelo menos seis caracteres<br>";
        $senhaValid1 = false;
      } 

      if ($senha1 === $senha2){
        $senhaValid2 = true;
      } else {
        $_SESSION['errNewSenha2'] = "As senhas não são iguais<br>";
        $senhaValid2 = false;
      }

      //validando e criptografando
    if ($senhaValid1 && $senhaValid2){
        $criptoSenha = password_hash($senha1, PASSWORD_DEFAULT);
      } else {        
        $senhaOK = false;
      }
//salvando no json

    if($nomeOK && $emailOK && $senhaOK){
        $arrayinsert = ["nome" => $nomeUsuario, "email" => $email, "senha" => $criptoSenha];
        $arrayClientes[$email] = $arrayinsert;
        $arrayClientes = json_encode($arrayClientes);
        file_put_contents('usuarios.json', $arrayClientes);
        $_SESSION['msgCadastroUser'] = true;
        header('Location:createUsuario.php');
      } else {
        $_SESSION['msgCadastroUser'] = false;
        header('Location:createUsuario.php');
      }
}



?>