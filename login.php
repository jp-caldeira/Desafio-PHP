<?php

session_start();

var_dump($_POST);

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
          <input type="email" name="Email" value=""><br>
        <label for="pass">Senha:</label><br>
          <input type="password" name="pass" value=""><br>
        <br><button type="submit" name="Login" value="">Login</button>
      </form>

  </body>
</html>
