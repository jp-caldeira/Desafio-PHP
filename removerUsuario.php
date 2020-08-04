<?php

session_start();


if ($_POST){
  $arrayClientes = file_get_contents('usuarios.json');
  $arrayClientes = json_decode($arrayClientes, true);
    if(isset($_POST['remover'])){
        $email = $_POST['remover'];
        $_SESSION['nomeRemovido'] = $arrayClientes[$email]['nome'];
         unset($arrayClientes[$email]);
         $arrayClientes = json_encode($arrayClientes);
         file_put_contents('usuarios.json', $arrayClientes);
        $_SESSION['msgRemove'] = "O usuário <strong>".$_SESSION['nomeRemovido']."</strong> foi removido<br>";
        echo $_SESSION['msgRemove'];
        header("Location:indexUsuarios.php");
        }
}


 ?>
