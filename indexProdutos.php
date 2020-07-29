<?php

$arrayProdutos = file_get_contents('produtos.json');

$arrayProdutos = json_decode($arrayProdutos, true);


foreach($arrayProdutos as $produto){
    foreach($produto as $key => $value){
      echo $key.": ".$value."<br>";
    }
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
                <br><?=$produto['Descrição']?>
                <br>Preço: R$ <?=$produto['preço']?>
                <br>ID: <?=$key ?>
                <br><img src="<?=$produto['imagem']?>" alt="" width="200" height="300">
              </div>
        <?php  }
        ?>
  </body>
</html>
