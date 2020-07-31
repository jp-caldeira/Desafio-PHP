<?php

session_start();

$arrayProdutos = file_get_contents('produtos.json');

$arrayProdutos = json_decode($arrayProdutos, true);

if(isset($_SESSION['msgEdit'])){
    echo $_SESSION['msgEdit'];
    unset($_SESSION['msgEdit']);
}


 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Index Produtos</title>
  </head>
  <body>
      <h1>Lista de Produtos</h1>
  <?php
  foreach($arrayProdutos as $key => $produto){
          ?>
              <div class="">
                <h3><a href="editProduto.php?produto=<?=$produto['idProduto']?>"><?=$produto['nome']?></a></h3>
                <span>Preço: R$ <?=$produto['preço']?>
                <br>ID: <?=$key ?>
                <br><?=$produto['descrição']?>

              </div>
        <?php  }
        ?>
  </body>
</html>
