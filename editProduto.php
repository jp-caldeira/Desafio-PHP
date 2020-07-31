<?php

session_start();

$arrayProdutos = file_get_contents('produtos.json');
$arrayProdutos = json_decode($arrayProdutos, true);
$produtoId = $_GET['produto'];

if(!$_GET){
   $_SESSION['msgEdit'] = "Escolha um produto para editar";
   header('Location:indexProdutos.php');
   }



 ?>



</body>
</html>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
  </head>
  <body>
    <h1>Editar informações do produto</h1>
    <div class="">
      <h2><?=$arrayProdutos[$produtoId]['nome']?></h2>
      <p>Imagem:
      <img src="<?=$arrayProdutos[$produtoId]['imagem']?>" alt="" width="100" height="100"></p>
      <p>Descrição do produto: <?=$arrayProdutos[$produtoId]['Descrição']?></p>
      <p>Preço: R$ <?=$arrayProdutos[$produtoId]['preço']?></p>
      <p>ID: <?=$arrayProdutos[$produtoId]['idProduto'] ?></p>
    </div>


  </body>
</html>
