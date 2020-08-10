<?php

session_start();

if(!isset($_SESSION['usuariologado'])){
    header('Location:acess-denied.html');
    die();
}

  if(isset($_GET['produto'])){
      $arrayProdutos = file_get_contents('produtos.json');
      $arrayProdutos = json_decode($arrayProdutos, true);
      $produtoId = $_GET['produto'];
  }


  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar produto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include_once 'navbar.php'; ?>
    <div class="container conteudo text-center">
        <?php if (isset($_GET['produto'])) : ?>
        <h1 class="display-4 p-3"><?=$arrayProdutos[$produtoId]['nome']?></h1>
        <div class="row">
          <div class="col-5 offset-1">
            <img class="img-fluid" src="<?=$arrayProdutos[$produtoId]['imagem']?>" alt="">
          </div>
            <div class="col-5">
              <ul class="list-group">
                <li class="list-group-item"><strong>Preço:</strong> R$ <?=$arrayProdutos[$produtoId]['preço']?></li>
                <li class="list-group-item"><strong>ID: </strong> <?=$arrayProdutos[$produtoId]['idProduto'] ?></li>
                <li class="list-group-item"><strong>Descrição: </strong><?=$arrayProdutos[$produtoId]['descrição']?></li>
                <br>
                <br>
                <a type="button" class="btn btn-primary" href="editProduto.php?produto=<?=$produtoId?>">Editar</a>
                <br>
                <a type="button" class="btn btn-secondary" href="indexProdutos.php">Voltar</a>
                </ul>

        </div>
    </div>

      <?php else : ?>
            <p>Escolha um produto para visualizar na <a href='indexProdutos.php'>lista de produtos</a></p>
        <?php endif; ?>
</div>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
