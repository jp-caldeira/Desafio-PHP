<?php

session_start();

if(!isset($_SESSION['usuariologado'])){
    header('Location:acess-denied.html');
    die();
}

  if(isset($_GET['produto'])){
      $arrayProdutos = file_get_contents('produtos.json');
      $arrayProdutos = json_decode($arrayProdutos, true);
      $produtoId = $_GET['produto'];
  }


  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar produto</title>
  </head>
  <body>
      <h1>Visualizar produto</h1>
      <div class="">
        <?php if (isset($_GET['produto'])) : ?>
        <h2><?=$arrayProdutos[$produtoId]['nome']?></h2>
            <img src="<?=$arrayProdutos[$produtoId]['imagem']?>" alt=""></p>
            <p>Descrição do produto: <?=$arrayProdutos[$produtoId]['descrição']?></p>
            <p>Preço: R$ <?=$arrayProdutos[$produtoId]['preço']?></p>
            <p>ID: <?=$arrayProdutos[$produtoId]['idProduto'] ?></p>
          <button><a href="editProduto.php?produto=<?=$produtoId?>">Editar</a></button>
      <?php else : ?>
            <p>Escolha um produto para visualizar na <a href='indexProdutos.php'>lista de produtos</a></p>
        <?php endif; ?>
      </div>

  </body>
</html>
