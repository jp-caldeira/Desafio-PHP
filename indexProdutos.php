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
    <meta name="viewport" content="width=device-width, inital-scale=1.0">
    <title>Index Produtos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include 'navbar.php';
    if(isset($_SESSION['removeProduto'])){
    echo "<div style='background-color:yellow'>$_SESSION[removeProduto]</div>";
    unset($_SESSION['removeProduto']);
}


if(isset($_SESSION['msgEdit'])){
  echo "<div style='background-color:yellow'>$_SESSION[msgEdit]</div>";
    unset($_SESSION['msgEdit']);
} ?>

<div class="container conteudo">
      <h1 class="display-4 p-3 text-center">Lista de Produtos</h1>
  <?php if($arrayProdutos){ ?>
    <table class="table table-bordered table-hover">
      <thead class="thead-dark text-center">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nome do produto</th>
          <th scope="col">Preço</th>
          <th scope="col">Descrição</th>
          <th scope="col"></th>
          <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
  <?php foreach($arrayProdutos as $key => $produto){ ?>
            <tr>
              <th scope="row"><?=$key ?></th>
                <td><a href="showProduto.php?produto=<?=$produto['idProduto']?>"><?=$produto['nome']?></td>
                <td class="text-center">R$ <?=$produto['preço']?></td>
                <td><?=$produto['descrição']?></td>
                <td class="text-center"><a type="button" class="btn btn-primary btn-sm" href="showProduto.php?produto=<?=$key?>">Exibir</a></td>
                <td class="text-center"><a type="button" class="btn btn-secondary btn-sm" href="editProduto.php?produto=<?=$key?>">Editar</a></td>
              </tr>
        <?php } } else { ?>
       <p class="alert alert-warning">Nenhuma informação para exibir. Vá para a página de <a href='createProduto.php'>cadastro de produtos</a></p>
     <?php } ?>
   </thead>
   </table>
 </div>
 <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
