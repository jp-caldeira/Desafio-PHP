<?php

session_start();

//infos antigas salvas caso a última validação dê errado
$currentName = $_SESSION['currentName'];
$currentEmail = $_SESSION['currentEmail'];
$currentPass = $_SESSION['currentPass'];
////
$senhaValid1 = true;
$senhaValid2 = true;
$nomeOK = true;
$emailOK = true;
$senhaOK = true;

$arrayClientes = file_get_contents('../json/usuarios.json');
$arrayClientes = json_decode($arrayClientes, true);



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
      $_SESSION['erroNome'] =  "Nome inválido<br>";
      $nomeOK = false;
    }
  //validando email
  if(empty($email)) {
    $_SESSION['erroEmail'] = "Email inválido<br>";
    $email = $currentEmail;
    $emailOK = false;
  }


  //validando senha
  if(strlen($senha1) < 6){
      $senhaValid1 = false;
      }

    if ($senha1 !== $senha2){
        $senhaValid2 = false;
      }

      //validando e criptografando
    if ($senhaValid1 && $senhaValid2){
        $criptoSenha = password_hash($senha1, PASSWORD_DEFAULT);
      } else {
        $_SESSION['erroSenha'] = "Há algo de errado com a senha. Ou ela tem menos de seis caracteres ou as senhas não são iguais<br>";
        $senhaOK = false;
      }
//salvando no json

    if($nomeOK && $emailOK && $senhaOK){
        unset($arrayClientes[$currentEmail]);
        foreach ($arrayClientes as $clientes){
                  $newEmail = $clientes["email"];
                  $arrayEmails[] = $newEmail;}

            if (in_array($email, $arrayEmails)){
                $_SESSION['erroEmail'] = "Email já cadastrado no sistema.<br>";
                $_SESSION['msgCadastro'] = false;
                $arrayInsert = ["nome" => $currentName, "email" => $currentEmail, "senha" => $currentPass];
                $arrayClientes[$currentEmail] = $arrayInsert;
                $arrayClientes = json_encode($arrayClientes);
                file_put_contents('../json/usuarios.json', $arrayClientes);
                header("Location:../../editUsuario.php?usuario=$currentEmail");
                die();
            } else {
                $arrayinsert = ["nome" => $nomeUsuario, "email" => $email, "senha" => $criptoSenha];
                $arrayClientes[$email] = $arrayinsert;
                $arrayClientes = json_encode($arrayClientes);
                file_put_contents('../json/usuarios.json', $arrayClientes);
                $_SESSION['msgCadastro'] = true;
                header("Location:../../editUsuario.php?usuario=$email");
          }
      } else {
          $_SESSION['msgCadastro'] = false;
          header("Location:../../editUsuario.php?usuario=$email");
      }
}

 ?>
