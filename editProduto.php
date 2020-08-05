<?php

session_start();

//verificando login
if(!isset($_SESSION['usuariologado'])){
    header('Location:acess-denied.html');
    die();
}

//verifica se foi selecionado alguma produto para editar
if(!$_GET){
  $_SESSION['msgEdit'] = "Escolha um produto para editar";
  header('Location:indexProdutos.php');
  die();
   }

//pegando infos no json
$arrayProdutos = file_get_contents('produtos.json');
$arrayProdutos = json_decode($arrayProdutos, true);
$produtoId = $_GET['produto'];
$_SESSION['produtoId'] = $produtoId;





 ?>



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
      <?php if (isset($_SESSION['editProduto'])){
                echo $_SESSION['editProduto'];
                unset($_SESSION['editProduto']);
                }
                 ?>
      <p>Nome do Produto:<?=$arrayProdutos[$produtoId]['nome']?></p>
      <p>Descrição do produto: <?=$arrayProdutos[$produtoId]['descrição']?></p>
      <p>Preço: R$ <?=$arrayProdutos[$produtoId]['preço']?></p>
      <p>ID: <?=$arrayProdutos[$produtoId]['idProduto'] ?></p>
      <p>Imagem:</p>
      <img src="<?=$arrayProdutos[$produtoId]['imagem']?>" alt="" width="200" height="200">
    </div>
    <form class="" action="editProd2.php" method="post" enctype="multipart/form-data">
      <label for="nomeProduto">Nome do produto:</label><br>
           <input type="text" name="NomeProduto" value="<?=$arrayProdutos[$produtoId]['nome']?>" ><br>
          <br><label for="precoProduto">Preço:</label><br>
           <input type="number" name="precoProduto" min="0" step="0.01" value="<?=$arrayProdutos[$produtoId]['preço']?>"><br>
           <?php // echo $precoOK ? "" : "<strong>Preço incorreto! O preço do produto não pode estar vazio</strong><br>"; ?>
           <br><label for="imgProduto">Insira a imagem do produto:</label><br>
         <input type="file" name="imgProduto" value=""><br>
         <?php // echo $fotoExt ? "" : "A foto deve ser um arquivo JPEG, JPG ou PNG<br>"; ?>
         <br><label for="descricaoProduto">Descrição do produto (opcional):</label><br>
              <textarea name="descricaoProduto" value="<?=$arrayProdutos[$produtoId]['descrição']?>" rows="4" cols="50"><?=$arrayProdutos[$produtoId]['descrição']?></textarea><br><br>
     <button type="submit" name="Enviar" value="">Enviar</button>
    </form>
    <form class="" action="removeProduto.php" method="post">
        <button type="submit" name="remover" value="<?=$arrayProdutos[$produtoId]['idProduto']?>">Remover Produto</button>
    </form>

  </body>
</html>
