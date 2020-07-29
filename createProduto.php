<?php

//criar uma tela com um formulário no qual o usuário poderá cadastrar produtos
//deve ter os seguintes campos:
//- nome do produto
//- descrição do produto
//- preço
//- foto (upload)

//deve-se validar os campos do lado do servidor, e, eventualmente, destacar os campos preenchidos incorretamente
//segundos os critérios:
// - preço deve ser número
// - nome do produto e a foto são obrigatórios
//descrição é opcional
//salvar num arquivo json
//cada produto deve ter um número inteiro único como identificador

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
                    <input type="text" name="NomeProduto" value="" required><br><br>
               <label for="precoProduto">Preço:</label><br>
                    <input type="text" name="precoProduto" value="" required><br><br>
               <label for="imgProduto">Insira a imagem do produto:</label><br>
                  <input type="file" name="imgProduto" value="" required><br><br>
                  <label for="descricaoProduto">Descrição do produto (opcional):</label><br>
                       <textarea name="descricaoProduto" value="" rows="4" cols="50"></textarea><br><br>
              <button type="submit" name="Enviar" value="">Enviar</button>
         </form>
<?php if($_POST){
  echo "var_dump no POST:<br><br>";
  var_dump($_POST);
  echo "<br>";
} else {
  echo "Sem informações para exibir<br><br>";
}


if($_FILES){
echo "<br>var_dump no FILES:<br><br>";
var_dump($_FILES);
echo "<br>";
} else {
echo "Sem informações para exibir<br>";
}

if($_POST){
echo "<br>Valores inseridos no $ POST:<br><br>";
foreach ($_POST as $key => $value) {
 echo $key.": ".$value."<br>";
}
}

if($_FILES){
  echo "<br>Valores inseridos no $ FILES [imgProduto]:<br><br>";
  foreach ($_FILES['imgProduto'] as $key => $value) {
    echo $key.": ".$value."<br>";
  }
}


//pegando infos do json
$arrayProdutos = file_get_contents('produtos.json');

$arrayProdutos = json_decode($arrayProdutos, true);

//setando um id que autoincrementa
if (!isset($arrayProdutos)){
   $id = 1;
 } else {
   $ultimoId = array_key_last($arrayProdutos);
   $id = $ultimoId + 1;
 }

//salvando a imagem na pasta
if ($_FILES){
    $tempfile = $_FILES['imgProduto']['tmp_name'];
    $arquivoExt = pathinfo($_FILES['imgProduto']['name'], PATHINFO_EXTENSION);
    $arquivoNome = "imgProduto".$id.".".$arquivoExt;
    move_uploaded_file($tempfile, 'img/'.$arquivoNome);
}







?>

   </body>
 </html>
