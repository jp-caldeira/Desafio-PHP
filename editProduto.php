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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <?php include 'navbar.php' ?>
    <div class="container conteudo text-center mb-4">
    <h1 class="display-4 p-3">Editar informações do produto</h1>
          <?php if (isset($_SESSION['editProduto'])){
               if ($_SESSION['editProduto']){ ?>
            <div class='alert alert-success'>Produto editado com sucesso! Confira as informações abaixo:</div>
                 <?php unset($_SESSION['editProduto']);
              } else { ?>
                <div class="alert alert-danger">As informações não foram alteradas. Por favor, verifique os erros abaixo:</div>
              <?php unset($_SESSION['editProduto']); }
                  } ?>
    <div class="container ">
      <p><strong>Nome do produto:</strong> <?=$arrayProdutos[$produtoId]['nome']?></p>
      <p><strong>Descrição: </strong><?=$arrayProdutos[$produtoId]['descrição']?></p>
      <p><strong>Preço:</strong> R$ <?=$arrayProdutos[$produtoId]['preço']?></p>
      <p><strong>ID: </strong><?=$arrayProdutos[$produtoId]['idProduto'] ?></p>
      <p><strong>Imagem:</strong></p>
      <img class="img-fluid" src="<?=$arrayProdutos[$produtoId]['imagem']?>" alt="" width="307" height="240">
    </div>
      <h4 class="alert alert-info mt-4">Insira as informações abaixo para editar o produto</h5>
    <form class="form-group p-2" action="editProd2.php" method="post" enctype="multipart/form-data">
                    <!-- nome -->
      <div class="form-row">
        <div class="col-3 offset-2">
          <label for="nomeProduto">Nome do produto:</label><br>
        </div>
        <div class="col-3">
                    <?php if(isset($_SESSION['errNomeProduto'])) : ?>
                    <input class="form-control form-control-sm is-invalid" type="text" name="NomeProduto" value="<?=$arrayProdutos[$produtoId]['nome']?>" required>
                         <div class="invalid-feedback">
                             <?php echo $_SESSION['errNomeProduto'];
                                  unset($_SESSION['errNomeProduto']);?>
                         </div><br>
                   <?php else: ?>
                   <input class="form-control form-control-sm" type="text" name="NomeProduto" value="<?=$arrayProdutos[$produtoId]['nome']?>" required><br>
                 <?php  endif; ?>
        </div>
      </div>
      <!-- preço -->

      <div class="form-row">
          <div class="col-3 offset-2">
            <label for="precoProduto">Preço:</label>
          </div>
            <?php if(isset($_SESSION['erroPreco'])): ?>
            <div class="col-3">
            <input class="form-control form-control-sm is-invalid" type="number" name="precoProduto" min="0" step="0.01" value="<?=$arrayProdutos[$produtoId]['preço']?>" required>
              <div class="invalid-feedback">
                <?php echo $_SESSION['erroPreco'];
                      unset($_SESSION['erroPreco']); ?>
              </div><br>
            </div>
            <?php else: ?>
              <div class="col-1">
                <input class="form-control form-control-sm" type="number" name="precoProduto" min="0" step="0.01" value="<?=$arrayProdutos[$produtoId]['preço']?>" required><br>
              </div>
          <?php endif; ?>
      </div>
                <!-- imagem -->
      <div class="form-row">
          <div class="col-3 offset-2">
            <label for="imgProduto">Insira a imagem do produto:</label>
          </div>
              <div class="col-4">
                  <?php if(isset($_SESSION['erroFoto1'])){ ?>
                    <input type="file" class="is-invalid" name="imgProduto" value="">
                    <div class="invalid-feedback">
                    <?php echo $_SESSION['erroFoto1'];
                          unset($_SESSION['erroFoto1']); ?>
                    </div>
                    <?php } elseif (isset($_SESSION['erroFoto2'])){ ?>
                    <input type="file" class="is-invalid" name="imgProduto" value="">
                    <div class="invalid-feedback">
                    <?php echo $_SESSION['erroFoto2'];
                          unset($_SESSION['erroFoto2']); ?>
                    </div>
                    <?php } else { ?>
                    <input type="file" name="imgProduto" value="">
                    <?php } ?>
                    </div>
              </div>
              <div class="form-row my-4">
                <div class="col-3 offset-2">
                    <label for="descricaoProduto">Descrição do produto (opcional):</label><br>
                </div>
                <div class="col-4">
                  <textarea class="form-control form-control-sm" name="descricaoProduto" value="" rows="4" cols="50"></textarea><br>
                </div>
              </div>
                <button class="btn btn-primary col-4" type="submit" name="Enviar" value="">Enviar</button>
             </form>
             <form class="" action="removeProduto.php" method="post">
               <button type="submit" name="remover" class="btn btn-secondary col-4" value="<?=$arrayProdutos[$produtoId]['idProduto']?>">Remover Produto</button>
             </form>
  </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
