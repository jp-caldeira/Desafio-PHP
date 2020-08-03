<?php

include ('verify-login.php');

 ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Faça seu login</title>
  </head>
  <body>
      <h1>Faça seu login</h1>
      <form class="" action="verify-login.php" method="post">
        <label for="Email">E-mail:</label><br>
        <?php if(isset($_SESSION['emailErr'])): ?>
          <input type="email" name="Email" style="background:yellow" value="<?php if (isset($_SESSION['user'])) : echo $_SESSION['user']; unset($_SESSION['user']); else: echo ''; endif; ?>"><br>
            <?= $_SESSION['emailErr']."<br>";
             unset($_SESSION['emailErr']);
             else : ?>
           <input type="email" name="Email" value="<?php if (isset($_SESSION['user'])) : echo $_SESSION['user']; unset($_SESSION['user']); else: echo ''; endif; ?>"><br>
          <?php endif; ?>
        <label for="pass">Senha:</label><br>
          <?php if(isset($_SESSION['erroSenha'])):?>
            <input type="password" name="pass" style="background:yellow" value=""><br>
          <?php   echo $_SESSION['erroSenha'];
                  unset($_SESSION['erroSenha']);
                  else :?>
            <input type="password" name="pass" value=""><br>
          <?php endif; ?>
        <br><button type="submit" name="Login" value="">Login</button>
      </form>

  </body>
</html>
