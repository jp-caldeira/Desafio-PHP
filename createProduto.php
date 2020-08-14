<?php


session_start();

if(!isset($_SESSION['usuariologado'])){
    header('Location:assets/acess-denied.html');
    die();
}

$arrayProdutos = file_get_contents('assets/json/produtos.json');
$arrayProdutos = json_decode($arrayProdutos, true);

 ?>

<!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Cadastrar Produto</title>
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
     <link rel="stylesheet" href="assets/css/style.css">
   </head>
   <body>
     <?php include 'assets/navbar.php' ?>
     <div class="container conteudo text-center mb-4">
        <h1 class="display-4 p-3">Cadastro de produtos</h1>
     <?php

     if(isset($_SESSION['msgCadastro'])){
              $ultimoItem = array_key_last($arrayProdutos);
              if ($_SESSION['msgCadastro']){ ?>
              <div class='alert alert-success'>Cadastro realizado com sucesso! Confira as informações abaixo:</div>
                  <p>Nome: <?=$arrayProdutos[$ultimoItem]['nome']?></p>
                  <p>Preço: R$ <?=$arrayProdutos[$ultimoItem]['preço']?></p>
                  <p>ID: <?=$arrayProdutos[$ultimoItem]['idProduto']?></p>
                  <p>Descrição do produto: <?=$arrayProdutos[$ultimoItem]['descrição']?></p>
                  <img class="img-fluid img-thumbnail" src="<?=$arrayProdutos[$ultimoItem]['imagem']?>" alt="" width="307" height="240"></p>
            <?php unset($_SESSION['msgCadastro']);
                } else { ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">Produto não foi cadastrado. Por favor, verifique os erros abaixo:
                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
                    </div>
                <?php unset($_SESSION['msgCadastro']); }
                    } ?>

            <h5 class="mb-4">Insira as informações abaixo para cadastrar um novo produto</h5>
         <form class="form-group p-2" action="assets/create/newProduto.php" method="post" enctype="multipart/form-data">
              <div class="form-row">
                     <div class="col-3 offset-2">
                       <label for="nomeProduto">Nome do produto:</label>
                     </div>
                       <div class="col-3">
                         <?php if(isset($_SESSION['errNomeProduto'])) : ?>
                         <input class="form-control form-control-sm is-invalid" type="text" name="NomeProduto" value="" required>
                              <div class="invalid-feedback">
                                  <?php echo $_SESSION['errNomeProduto'];
                                       unset($_SESSION['errNomeProduto']);?>
                              </div><br>
                        <?php else: ?>
                        <input class="form-control form-control-sm" type="text" name="NomeProduto" value="" required><br>
                      <?php  endif; ?>
                      </div>
                </div>
            <div class="form-row">
                <div class="col-3 offset-2">
                  <label for="precoProduto">Preço:</label>
                </div>
                  <?php if(isset($_SESSION['erroPreco'])): ?>
                  <div class="col-3">
                  <input class="form-control form-control-sm is-invalid" type="number" name="precoProduto" min="0" step="0.01" value="" required>
                    <div class="invalid-feedback">
                      <?php echo $_SESSION['erroPreco'];
                            unset($_SESSION['erroPreco']); ?>
                    </div><br>
                  </div>
                  <?php else: ?>
                    <div class="col-1">
                      <input class="form-control form-control-sm" type="number" name="precoProduto" min="0" step="0.01" value="" required><br>
                    </div>
                <?php endif; ?>
            </div>
      <div class="form-row">
            <div class="col-3 offset-2">
                <label for="imgProduto">Insira a imagem do produto:</label>
            </div>
            <div class="col-4">
              <?php if(isset($_SESSION['erroFoto1'])){ ?>
                <input type="file" class="is-invalid" name="imgProduto" value="" required>
                  <div class="invalid-feedback">
                  <?php echo $_SESSION['erroFoto1'];
                    unset($_SESSION['erroFoto1']); ?>
                  </div>
                <?php } elseif (isset($_SESSION['erroFoto2'])){ ?>
                  <input type="file" class="is-invalid" name="imgProduto" value="" required>
                  <div class="invalid-feedback">
                  <?php echo $_SESSION['erroFoto2'];
                      unset($_SESSION['erroFoto2']); ?>
                    </div>
                  <?php } else { ?>
                    <input type="file" name="imgProduto" value="" required>
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
          <button class="btn btn-primary" type="submit" name="Enviar" value="">Enviar</button>
     </form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
   </body>
 </html>
