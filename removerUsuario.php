<?php

session_start();

if ($_POST){
  $arrayClientes = file_get_contents('usuarios.json');
  $arrayClientes = json_decode($arrayClientes, true);
    if(isset($_POST['remover'])){
        $email = $_POST['remover'];
        "<br>Usuário <strong>".$email."</strong>foi removido.<br><br>";        
        unset($arrayClientes[$email]);
        $arrayClientes = json_encode($arrayClientes);
        file_put_contents('usuarios.json', $arrayClientes);
        $_SESSION['msgRemove'] = "O usuário <strong>".$email."</strong> foi removido";
        header("Location:indexUsuarios.php");
        }
}


 ?>
