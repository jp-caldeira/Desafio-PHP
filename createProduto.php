<?php


session_start();

if(!isset($_SESSION['usuariologado'])){
    header('Location:acess-denied.html');
    die();
}

$arrayProdutos = file_get_contents('produtos.json');
$arrayProdutos = json_decode($arrayProdutos, true);

 ?>

<!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Cadastrar Produto</title>
   </head>
   <body>
     <h1>Cadastro de produtos</h1>
     <?php

     if(isset($_SESSION['msgCadastro'])){
              $ultimoItem = array_key_last($arrayProdutos);
              if ($_SESSION['msgCadastro']){ ?>
              <br><p style='background-color:lightgreen'>Cadastro realizado com sucesso! Confira as informações abaixo:</p>
                  <p>Nome:<?=$arrayProdutos[$ultimoItem]['nome']?></p>
                  <p>Descrição do produto:<?=$arrayProdutos[$ultimoItem]['descrição']?></p>
                  <p>Preço: R$ <?=$arrayProdutos[$ultimoItem]['preço']?></p>
                  <p>ID:<?=$arrayProdutos[$ultimoItem]['idProduto']?></p>
                  <img src="<?=$arrayProdutos[$ultimoItem]['imagem']?>" alt=""></p>

            <?php unset($_SESSION['msgCadastro']);
                } else { ?>
                  <p style='background-color:red'>Produto não foi cadastrado. Por favor, verifique os erros abaixo:</p>
                <?php unset($_SESSION['msgCadastro']); }
                    } ?>

            <h3>Insira as informações abaixo para cadastrar um novo produto</h3>
         <form action="newProduto.php" method="post" enctype="multipart/form-data">
               <label for="nomeProduto">Nome do produto:</label><br>
                    <input type="text" name="NomeProduto" value="" required><br>

                    <?php if(isset($_SESSION['errNomeProduto'])) {
                        echo $_SESSION['errNomeProduto'];
                        unset($_SESSION['errNomeProduto']);
                    } ?>

              <br><label for="precoProduto">Preço:</label><br>
                    <input type="number" name="precoProduto" min="0" step="0.01" value="" required><br>
                    <?php if(isset($_SESSION['erroPreco'])){
                        echo $_SESSION['erroPreco'];
                        unset($_SESSION['erroPreco']);
                    } ?>

              <br><label for="imgProduto">Insira a imagem do produto:</label><br>
                  <input type="file" name="imgProduto" value="" required><br>
                  <?php if(isset($_SESSION['erroFoto1'])){
                      echo $_SESSION['erroFoto1'];
                      unset($_SESSION['erroFoto1']);
                        }
                        if(isset($_SESSION['erroFoto2'])){
                            echo $_SESSION['erroFoto2'];
                            unset($_SESSION['erroFoto2']);
                            } ?>

              <br><label for="descricaoProduto">Descrição do produto (opcional):</label><br>
                 <textarea name="descricaoProduto" value="" rows="4" cols="50"></textarea><br><br>
              <button type="submit" name="Enviar" value="">Enviar</button>
         </form>


   </body>
 </html>
