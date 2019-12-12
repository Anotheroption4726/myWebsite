<?php




  session_start();
  include('db_connect.php');




  if (isset($_SESSION['session_username']))
  {
    header('location:index.php');
  }




  include('section/section_register.php');




?>

<!DOCTYPE html>
<html>
    <head>
          <meta charset="utf-8" />
          <title>Register</title>
          <body>

            <p>Veuillez entrer un nouveau nom d'utilisateur et un nouveau mot de passe</p>
            <p><a href="index.php">Login</a></p>

          </body>
    </head>
</html>
