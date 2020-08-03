<?php

session_start();

$arrayProdutos = file_get_contents('produtos.json');
$arrayProdutos = json_decode($arrayProdutos, true);
$produtoId = $_GET['produto'];


 if(!$_GET){
   $_SESSION['msgEdit'] = "Escolha um produto para editar";
   header('Location:indexProdutos.php');
   die();
    }

$nomeOK = true;
$precoOK = true;
$fotoOK = true;

   //validação nome
if($_POST){
    $nomeProduto = $_POST['NomeProduto'];
    $nomeProduto = trim($nomeProduto);
    if (empty($nomeProduto) || strlen($nomeProduto) < 3){
     echo "<br>O campo <strong>NOME</strong> do produto não foi digitado corretamente<br>";
     $nomeOK = false;
   } else {
     $arrayProdutos[$produtoId]['nome'] = $nomeProduto;
      }
   }



   //validação preço
   if($_POST){
     $preco = $_POST['precoProduto'];
     $preco = str_replace(",",".", $preco);
        if(!is_numeric($preco) || $preco < 0){
         echo "<br><br>O <strong>preço</strong> foi digitado incorretamente. <strong>PREÇO</strong> não pode ser vazio nem ser negativo<br>";
          $precoOK = false;
        } else {
          $arrayProdutos[$produtoId]['preço'] = $preco;
        }
   }

   //descricao
   if($_POST){
     $descrição = $_POST['descricaoProduto'];
     $arrayProdutos[$produtoId]['descrição'] = $descrição;
   }


   //validando se a foto é um arquivo válido
   $validExt = ["image/jpeg", "image/jpg", "image/png"];

   if($_FILES){
     $tipoImagem = $_FILES['imgProduto']['type'];
     if ($_FILES['imgProduto']['error'] === UPLOAD_ERR_OK){
       if (array_search($tipoImagem, $validExt) === false) {
           echo "A extensão de arquivo da <strong>foto</strong> é inválida. Por favor, envie um arquivo JPEG, JPG, ou PNG<br>";
           $fotoExt = false;
       } else {
           $fotoExt = true;
       }
     }
   }

var_dump($_GET);
echo "<br><br>";
var_dump($produtoId);
echo "<br><br>";
   //validando e salvando foto
   if($_FILES){
       if (!empty($_FILES['imgProduto']['name'] && $fotoExt === true)){
           $tempfile = $_FILES['imgProduto']['tmp_name'];
           $arquivoExt = pathinfo($_FILES['imgProduto']['name'], PATHINFO_EXTENSION);
           $arquivoNome = "imgProduto".$produtoId.".".$arquivoExt;
           echo "o nome do arquivo é ".$arquivoNome;
           move_uploaded_file($tempfile, 'img/'.$arquivoNome);
           $arrayProdutos[$produtoId]['imagem'] = "img/".$arquivoNome;
           $fotoOK = true;
         } else {
           $fotoOK = false;
         }
   }

   //salvando as novas informações no json
   $arrayProdutos = json_encode($arrayProdutos);
   file_put_contents('produtos.json', $arrayProdutos);

   //pegando as informações do json para exibir na tela
   $arrayProdutos = file_get_contents('produtos.json');
   $arrayProdutos = json_decode($arrayProdutos, true);
   unset($_COOKIE);

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
      <h2><?=$arrayProdutos[$produtoId]['nome']?></h2>
      <p>Imagem:
      <img src="<?=$arrayProdutos[$produtoId]['imagem']?>" alt="" width="100" height="100"></p>
      <p>Descrição do produto: <?=$arrayProdutos[$produtoId]['descrição']?></p>
      <p>Preço: R$ <?=$arrayProdutos[$produtoId]['preço']?></p>
      <p>ID: <?=$arrayProdutos[$produtoId]['idProduto'] ?></p>
    </div>
    <form class="" action="editProduto.php?produto=<?=$produtoId?>" method="post" enctype="multipart/form-data">
      <label for="nomeProduto">Nome do produto:</label><br>
           <input type="text" name="NomeProduto" value="<?=$arrayProdutos[$produtoId]['nome']?>" ><br>
           <?php echo $nomeOK ? "" : "<strong>Nome foi digitado incorretamente</strong><br>"; ?>
      <br><label for="precoProduto">Preço:</label><br>
           <input type="text" name="precoProduto" value="<?=$arrayProdutos[$produtoId]['preço']?>"><br>
           <?php echo $precoOK ? "" : "<strong>Preço incorreto! O preço do produto não pode estar vazio</strong><br>"; ?>
           <br><label for="imgProduto">Insira a imagem do produto:</label><br>
         <input type="file" name="imgProduto" value=""><br>
         <?php echo $fotoOK ? "" : "<strong>Você deve inserir uma foto do produto para realizar o cadastro.</strong> A foto deve ser um arquivo JPEG, JPG ou PNG<br>"; ?>
         <br><label for="descricaoProduto">Descrição do produto (opcional):</label><br>
              <textarea name="descricaoProduto" value="<?=$arrayProdutos[$produtoId]['descrição']?>" rows="4" cols="50"><?=$arrayProdutos[$produtoId]['descrição']?></textarea><br><br>
     <button type="submit" name="Enviar" value="">Enviar</button>

    </form>

  </body>
</html>
