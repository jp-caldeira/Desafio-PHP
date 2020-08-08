<?php

session_start();

//verificando login
if(!isset($_SESSION['usuariologado'])){
    header('Location:acess-denied.html');
    die();
}

//verifica se foi selecionado algum produto para editar
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
          <?php if (isset($_SESSION['editProduto'])){
               if ($_SESSION['editProduto']){ ?>
            <br><p style='background-color:lightgreen'>Cadastro realizado com sucesso! Confira as informações abaixo:</p>
                 <?php unset($_SESSION['editProduto']);
              } else { ?>
                <p style='background-color:red'>Produto não foi cadastrado. Por favor, verifique os erros abaixo:</p>
              <?php unset($_SESSION['editProduto']); }
                  } ?>

    <div class="">
      <p>Nome do Produto: <?=$arrayProdutos[$produtoId]['nome']?></p>
      <p>Descrição do produto: <?=$arrayProdutos[$produtoId]['descrição']?></p>
      <p>Preço: R$ <?=$arrayProdutos[$produtoId]['preço']?></p>
      <p>ID: <?=$arrayProdutos[$produtoId]['idProduto'] ?></p>
      <p>Imagem:</p>
      <img src="<?=$arrayProdutos[$produtoId]['imagem']?>" alt="" width="200" height="200">
    </div>
    <form class="" action="editProd2.php" method="post" enctype="multipart/form-data">
                    <!-- nome -->
      <label for="nomeProduto">Nome do produto:</label><br>
           <input type="text" name="NomeProduto" value="<?=$arrayProdutos[$produtoId]['nome']?>" required><br>

                <?php if(isset($_SESSION['errNomeProduto'])) {
                        echo $_SESSION['errNomeProduto'];
                        unset($_SESSION['errNomeProduto']);
                    } ?>
                <!-- preço -->
          <br><label for="precoProduto">Preço:</label><br>
           <input type="number" name="precoProduto" min="0" step="0.01" value="<?=$arrayProdutos[$produtoId]['preço']?>" required><br>

                 <?php if(isset($_SESSION['erroPreco'])){
                        echo $_SESSION['erroPreco'];
                        unset($_SESSION['erroPreco']);
                    } ?>
                <!-- imagem -->
           <br><label for="imgProduto">Insira a imagem do produto:</label><br>
         <input type="file" name="imgProduto" value=""><br>

                  <?php if(isset($_SESSION['erroFoto1'])){
                            echo $_SESSION['erroFoto1'];
                            unset($_SESSION['erroFoto1']);
                        }
                        if(isset($_SESSION['erroFoto2'])){
                            echo $_SESSION['erroFoto2'];
                            unset($_SESSION['erroFoto2']);
                            } ?>

         <br><label for="descricaoProduto">Descrição do produto (opcional):</label><br>
              <textarea name="descricaoProduto" value="<?=$arrayProdutos[$produtoId]['descrição']?>" rows="4" cols="50"><?=$arrayProdutos[$produtoId]['descrição']?></textarea><br><br>
     <button type="submit" name="Enviar" value="">Enviar</button>
    </form>
    <form class="" action="removeProduto.php" method="post">
        <button type="submit" name="remover" value="<?=$arrayProdutos[$produtoId]['idProduto']?>">Remover Produto</button>
    </form>

  </body>
</html>
