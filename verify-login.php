<?php

session_start();

if(isset($_POST['logoff'])){
  unset($_SESSION['usuariologado']);
  unset($_POST['logoff']);
  unset($_SESSION['user']);
  unset($_SESSION['pass']);
}

if($_POST){
    $emailLogin = $_POST['Email'];
    $_SESSION['user'] = $_POST['Email'];
    $pass = $_POST['pass'];
    $arrayClientes = file_get_contents('usuarios.json');
    $arrayClientes = json_decode($arrayClientes, true);

    foreach($arrayClientes as $cliente){
        $IDemail = $cliente['email'];
        $arrayEmails[] = $IDemail;
          }

if(isset($_POST['Email'])){
      if(in_array($emailLogin, $arrayEmails)){
        $emailLoginOK = true;
      } else {
        $_SESSION['emailErr'] = "Email não cadastrado no sistema!";
        $emailLoginOK = false;
        echo $_SESSION['emailErr'];
        header('location:login.php');
        die();
      }
}

      if($emailLoginOK){
        $senhaInput = $_POST['pass'];
        $senhaSalva = $arrayClientes[$emailLogin]['senha'];
        if (password_verify($senhaInput, $senhaSalva)) {
          echo "<br>as senhas são iguais<br>";
          $_SESSION['usuariologado'] = true;
          header('Location:painel-adm.php');
        } else {
          echo "<br>senha ERRADA!<br>";
          $_SESSION['erroSenha'] = "A senha está errada!<br>";
          header('location:login.php');
        }



      }


}







 ?>
