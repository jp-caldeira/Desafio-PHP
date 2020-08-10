<?php

include ('verify-login.php');

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Faça seu login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="main-content">
      <div class="inner">
        <h1>Faça seu login</h1>
          <form class="form-group p-2" action="verify-login.php" method="post">
            <label for="Email">E-mail:</label><br>
                <?php if(isset($_SESSION['emailErr'])): ?>
                <input type="email" name="Email" class="form-control form-control-sm is-invalid" value="<?php if (isset($_SESSION['user'])) : echo $_SESSION['user']; unset($_SESSION['user']); else: echo ''; endif; ?>">
                  <div class="invalid-feedback">
                <?= $_SESSION['emailErr']."<br>";
                unset($_SESSION['emailErr']); ?>
                  </div>
                <?php else : ?>
                <input type="email" name="Email" class="form-control form-control-sm" value="<?php if (isset($_SESSION['user'])) : echo $_SESSION['user']; unset($_SESSION['user']); else: echo ''; endif; ?>"><br>
                <?php endif; ?>
          <label for="pass">Senha:</label><br>
          <?php if(isset($_SESSION['erroSenha'])):?>
            <input type="password" name="pass" class="form-control form-control-sm is-invalid" value="">
            <div class="invalid-feedback">
          <?php   echo $_SESSION['erroSenha'];
                  unset($_SESSION['erroSenha']); ?>
              </div>
            <?php  else :?>
            <input type="password" class="form-control form-control-sm" name="pass" value=""><br>
          <?php endif; ?>
        <button type="submit" name="Login" class="btn btn-primary" value="">Login</button>
        </form>
    </div>
  </div>
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>
