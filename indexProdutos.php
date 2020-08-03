<?php

session_start();

if(!isset($_SESSION['usuariologado'])){
    header('Location:acess-denied.html');
    die();
}

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
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <title>Index Produtos</title>
  </head>
  <body>
      <h1>Lista de Produtos</h1>
  <?php if($arrayProdutos): foreach($arrayProdutos as $key => $produto):  ?>
              <div class="">
                <h3><a href="showProduto.php?produto=<?=$produto['idProduto']?>"><?=$produto['nome']?></a></h3>
                <span>Preço: R$ <?=$produto['preço']?>
                <br>ID: <?=$key ?>
                <br><?=$produto['descrição']?>

              </div>
        <?php  endforeach; else: ?>
       <p>Nenhuma informação para exibir. Vá para a página de <a href='createProduto.php'>cadastro de produtos</a></p>
     <?php endif; ?>

  </body>
</html>
