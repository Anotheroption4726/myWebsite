<?php




  session_start();
  include('db_connect.php');




  if (isset($_POST['login_username']) && isset($_POST['login_password']))
  {
    $req = $bdd->prepare('SELECT username, password FROM users_table WHERE username = :input_username AND password = :input_password');
    $req->execute(array('input_username' => $_POST['login_username'], 'input_password' => $_POST['login_password']));
    $data = $req->fetch();
    $req->closeCursor();

    if ($data != null)
    {
      $_SESSION['session_username'] = $data['username'];
    }
    else
    {
      $_SESSION['login_message'] = "incorrect_login";
    }
  }




  if (!isset($_SESSION['session_username']))
  {
    header('location:login.php');
  }




  echo '<p>Bonjour ' . $_SESSION['session_username'] .' !</p>';
  include('section/section_delete.php');
  include('section/section_logout.php');
  echo '<p><a href="chatbox.php">Go to chatbox</a></p>';




?>

<!DOCTYPE html>
<html>
    <head>
          <meta charset="utf-8" />
          <title>Index</title>
    </head>
</html>