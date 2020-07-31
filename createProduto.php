<?php

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
}
}

//validação preço
if($_POST){
  $preco = $_POST['precoProduto'];
  $preco = str_replace(",",".", $preco);
       if(!is_numeric($preco) || $preco < 0){
      echo "<br><br>O <strong>preço</strong> foi digitado incorretamente. <strong>PREÇO</strong> não pode ser vazio nem ser negativo<br>";
       $precoOK = false;
        }
}

//pegando infos do json
$arrayProdutos = file_get_contents('produtos.json');
$arrayProdutos = json_decode($arrayProdutos, true);

//setando um id
if (!isset($arrayProdutos)){
   $id = 1;
 } else {
   $ultimoId = array_key_last($arrayProdutos);
   $id = $ultimoId + 1;
 }

 //array com infos que vão para o json
 if($_POST){
     $arrayInsert = ['idProduto' => $id, 'nome' => $_POST['NomeProduto'], 'preço' => $_POST['precoProduto'],'descrição' => $_POST['descricaoProduto']];
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

//validando e salvando foto
if($_FILES){
    if (!empty($_FILES['imgProduto']['name'] && $fotoExt === true)){
        $tempfile = $_FILES['imgProduto']['tmp_name'];
        $arquivoExt = pathinfo($_FILES['imgProduto']['name'], PATHINFO_EXTENSION);
        $arquivoNome = "imgProduto".$id.".".$arquivoExt;
        move_uploaded_file($tempfile, 'img/'.$arquivoNome);
        $arrayInsert['imagem'] = "img/".$arquivoNome;
        $fotoOK = true;
      } else {
        $fotoOK = false;
      }
}

//botando infos no json
if(isset($arrayInsert)){
 if($precoOK && $nomeOK && $fotoOK){
       $arrayProdutos[$id] = $arrayInsert;
       $produtoData = json_encode($arrayProdutos);
       file_put_contents('produtos.json', $produtoData);
     echo "<br>Informações inseridas com sucesso! Veja as informações abaixo:<br>";
   foreach ($arrayInsert as $key => $value) {
       echo $key.": ".$value."<br>";
   } //tira esse foreach depois
   } else {
     echo "<br>Corrija suas informações para salvar o produto<br>";
   }
   }


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
         <form action="createProduto.php" method="post" enctype="multipart/form-data">
               <label for="nomeProduto">Nome do produto:</label><br>
                    <input type="text" name="NomeProduto" value="" ><br>
                    <?php echo $nomeOK ? "" : "<strong>Nome foi digitado incorretamente</strong><br>"; ?>
               <br><label for="precoProduto">Preço:</label><br>
                    <input type="text" name="precoProduto" value=""><br>
                    <?php echo $precoOK ? "" : "<strong>Preço incorreto! O preço do produto não pode estar vazio</strong><br>"; ?>
                    <br><label for="imgProduto">Insira a imagem do produto:</label><br>
                  <input type="file" name="imgProduto" value=""><br>
                  <?php echo $fotoOK ? "" : "<strong>Você deve inserir uma foto do produto para realizar o cadastro.</strong> A foto deve ser um arquivo JPEG, JPG ou PNG<br>"; ?>
                  <br><label for="descricaoProduto">Descrição do produto (opcional):</label><br>
                       <textarea name="descricaoProduto" value="" rows="4" cols="50"></textarea><br><br>
              <button type="submit" name="Enviar" value="">Enviar</button>
         </form>


   </body>
 </html>
