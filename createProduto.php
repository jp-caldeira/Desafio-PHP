<?php

//deve-se validar os campos do lado do servidor, e, eventualmente, destacar os campos preenchidos incorretamente
//segundos os critérios:
// - preço deve ser número
// - nome do produto e a foto são obrigatórios
//descrição é opcional
//salvar num arquivo json
//cada produto deve ter um número inteiro único como identificador

$nomeOK = true;
$precoOK = true;
$fotoOK = true;



if($_POST){
  $nomeProduto = $_POST['NomeProduto'];
  $nomeProduto = trim($nomeProduto);
if (empty($nomeProduto) || strlen($nomeProduto) < 3){
  echo "nome do produto não foi digitado corretamente";
  $nomeOK = false;
} 
}

if($_POST){
  $preco = $_POST['precoProduto'];
  $preco = str_replace(",",".", $preco);
       if(!is_numeric($preco) || $preco < 0){
      echo "preço digitado incorretamente. PREÇO não pode ser vazio nem ser negativo";
       $precoOK = false;
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
     <h1>Cadastre seu produto</h1>
         <form action="createProduto.php" method="post" enctype="multipart/form-data">
               <label for="nomeProduto">Nome do produto:</label><br>
                    <input type="text" name="NomeProduto" value="" required><br>
                    <?php echo $nomeOK ? "" : "Nome foi digitado incorretamente!<br>"; ?>
               <br><label for="precoProduto">Preço:</label><br>
                    <input type="text" name="precoProduto" value="" required><br>
                    <?php echo $precoOK ? "" : "Preço incorreto! O preço do produto não pode estar vazio!<br>"; ?>
                    <br><label for="imgProduto">Insira a imagem do produto:</label><br>
                  <input type="file" name="imgProduto" value="" required><br><br>
                  <label for="descricaoProduto">Descrição do produto (opcional):</label><br>
                       <textarea name="descricaoProduto" value="" rows="4" cols="50"></textarea><br><br>
              <button type="submit" name="Enviar" value="">Enviar</button>
         </form>
<?php


//pegando infos do json
$arrayProdutos = file_get_contents('produtos.json');

$arrayProdutos = json_decode($arrayProdutos, true);

//setando um id que 
if (!isset($arrayProdutos)){
   $id = 1;
 } else {
   $ultimoId = array_key_last($arrayProdutos);
   $id = $ultimoId + 1;
 }

//array que depois vai ir pro json
 if($_POST){
  $arrayInsert = ['idProduto' => $id, 'nome' => $_POST['NomeProduto'], 'preço' => $_POST['precoProduto'],'Descrição' => $_POST['descricaoProduto']];
 }

//salvando a imagem na pasta
if (isset($_FILES['name'])){
    $tempfile = $_FILES['imgProduto']['tmp_name'];
    $arquivoExt = pathinfo($_FILES['imgProduto']['name'], PATHINFO_EXTENSION);
    $arquivoNome = "imgProduto".$id.".".$arquivoExt;
    move_uploaded_file($tempfile, 'img/'.$arquivoNome);
    $arrayInsert["imagem"] = "img/".$arquivoNome;    
  } else {
    $fotoOK = false;
  }




//botando infos no json

if(isset($arrayInsert)){
  if($precoOK && $nomeOK && $fotoOK){
        $arrayProdutos[$id] = $arrayInsert;
        $produtoData = json_encode($arrayProdutos);
        file_put_contents('produtos.json', $produtoData);
      echo "<br>Informações inseridas com sucesso!<br>";
    foreach ($arrayInsert as $key => $value) {
        echo "<br>".$key.": ".$value."<br>";
    } //tira esse foreach depois
    } else {
      echo "<br><br>Corrija suas informações para salvar o produto.<br>";
    }
    } else {
      echo "<br>Insira suas informações acima......<br>";

    }






?>

   </body>
 </html>
