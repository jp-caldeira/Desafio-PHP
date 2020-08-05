<?php

session_start();


$nomeOK = true;
$precoOK = true;
$fotoOK = true;


//validação nome
if($_POST){
  $nomeProduto = $_POST['NomeProduto'];
  $nomeProduto = trim($nomeProduto);
if (empty($nomeProduto) || strlen($nomeProduto) < 3){
  $_SESSION['errNomeProduto'] = "O campo <strong>NOME</strong> do produto não foi digitado corretamente<br>";
  $nomeOK = false;
}
}

//validação preço
if($_POST){
  $preco = $_POST['precoProduto'];
  $preco = str_replace(",",".", $preco);
       if(!is_numeric($preco) || $preco < 0){
        $_SESSION['erroPreco'] = "O <strong>preço</strong> foi digitado incorretamente. <strong>PREÇO</strong> deve ser um valor númerico, não pode ser vazio nem ser negativo<br>";
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
        $_SESSION['erroFoto1'] = "A extensão de arquivo da <strong>foto</strong> é inválida. Por favor, envie um arquivo JPEG, JPG, ou PNG<br>";
        $fotoExt = false;
    } else {
        $fotoExt = true;
    }
  }
  if(empty($_FILES['imgProduto']['name'])){
      $_SESSION['erroFoto2'] = "Você deve inserir uma foto do produto para realizar o cadastro<br>";
      $imgName = false;
    } else {
      $imgName = true;
  }
}


//validando e salvando foto
if($_FILES){
    if ($imgName && $fotoExt){
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
     $_SESSION['msgCadastro'] = true;
     header('location:createProduto.php');
     } else {
     $_SESSION['msgCadastro'] = false;
     header('location:createProduto.php');
   }
 } else {
   $_SESSION['msgCadastro'] = false;
   header('location:createProduto.php');
 }


 ?>
