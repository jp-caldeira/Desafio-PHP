<?php
  var_dump($_POST);

if($_POST){
    $arrayClientes = file_get_contents('usuarios.json');
    $arrayClientes = json_decode($arrayClientes, true);

foreach($arrayClientes as $cliente){
    $IDemail = $cliente['email'];
    $arrayEmails[] = $IDemail;
}
}
var_dump($arrayEmails);


 ?>
