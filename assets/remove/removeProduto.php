<?php

session_start();

if($_POST){
  $arrayProdutos = file_get_contents('../json/produtos.json');
  $arrayProdutos  = json_decode($arrayProdutos, true);
    if(isset($_POST['remover'])){
      $id = $_POST['remover'];
      $nomeProduto = $arrayProdutos[$id]['nome'];
      unset($arrayProdutos[$id]);
      $arrayProdutos = json_encode($arrayProdutos);
      file_put_contents('../json/produtos.json', $arrayProdutos);
      $_SESSION['removeProduto'] = "O produto ".$nomeProduto." foi removido";
      header('Location:../../indexProdutos.php');
      die();
}
}

?>
