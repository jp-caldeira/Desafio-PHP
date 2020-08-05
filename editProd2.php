<?php

session_start();



$arrayProdutos = file_get_contents('produtos.json');
$arrayProdutos = json_decode($arrayProdutos, true);

$nomeOK = true;
$precoOK = true;
$fotoOK = true;
$fotoExt = true;
$produtoId = $_SESSION['produtoId'];

   //validação nome
if($_POST){
    $nomeProduto = $_POST['NomeProduto'];
    $nomeProduto = trim($nomeProduto);
    if (empty($nomeProduto) || strlen($nomeProduto) < 3){
     $nomeOK = false;
     $_SESSION['errNomeProduto'] = "O campo <strong>NOME</strong> do produto não foi digitado corretamente<br>";
     } else {
     $arrayProdutos[$produtoId]['nome'] = $nomeProduto;
     }
      //validação preço
       $preco = $_POST['precoProduto'];
        if(!is_numeric($preco) && $preco < 0){
          $precoOK = false;
          $_SESSION['erroPreco'] = "O <strong>preço</strong> foi digitado incorretamente. <strong>PREÇO</strong> deve ser um valor númerico, não pode ser vazio nem ser negativo<br>";
        } else {
          $arrayProdutos[$produtoId]['preço'] = $preco;
        }
      //descricao
     $descrição = $_POST['descricaoProduto'];
     $arrayProdutos[$produtoId]['descrição'] = $descrição;
   }



   //validando se a foto é um arquivo válido
   $validExt = ["image/jpeg", "image/jpg", "image/png"];


   if(!empty($_FILES['imgProduto']['name'])){
     $tipoImagem = $_FILES['imgProduto']['type'];
      if ($_FILES['imgProduto']['error'] === UPLOAD_ERR_OK){
        if (array_search($tipoImagem, $validExt) === false) {
           $fotoExt = false;
           $_SESSION['erroFoto1'] = "Erro extensão da foto<br>";
       } else {
           $fotoExt = true;
       }
     }
       //validando e salvando foto
     if ($fotoExt){
           $tempfile = $_FILES['imgProduto']['tmp_name'];
           $arquivoExt = pathinfo($_FILES['imgProduto']['name'], PATHINFO_EXTENSION);
           $arquivoNome = "imgProduto".$produtoId.".".$arquivoExt;
           move_uploaded_file($tempfile, 'img/'.$arquivoNome);
           $arrayProdutos[$produtoId]['imagem'] = "img/".$arquivoNome;
           $fotoOK = true;
         } else {
           $fotoOK = false;
         }
}


if($_POST){
   if($nomeOK && $precoOK && $fotoOK){
   $_SESSION['editProduto'] = "As informações foram atualizadas! Confira as informações abaixo:";
   header("Location:editProduto.php?produto=$produtoId");
 } else {
   $_SESSION['editProduto'] = "As informações não foram atualizadas. Por favor corrija os erros abaixo:";
   header("Location:editProduto.php?produto=$produtoId");
 }
}

   //salvando as novas informações no json
   $arrayProdutos = json_encode($arrayProdutos);
   file_put_contents('produtos.json', $arrayProdutos);

?>
