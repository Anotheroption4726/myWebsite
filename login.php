<?php




  session_start();
  include('db_connect.php');




  if(isset($_POST['delete']))
  {
    $req = $bdd->prepare('DELETE FROM users_table WHERE username = :delete_user');
    $req->execute(array('delete_user' => $_SESSION['session_username']));
    $req->closeCursor();

    unset($_SESSION);
    session_destroy();

    $_SESSION['login_message'] = "account_deleted";
  }




  if (isset($_POST['logout']))
  {
    unset($_SESSION);
    session_destroy();

    $_SESSION['login_message'] = "logged_out";
  }




  if(isset($_POST['register_username']) && isset($_POST['register_password']))
  {
    $req = $bdd->prepare('SELECT username FROM users_table WHERE username = :input_username');
    $req->execute(array('input_username' => $_POST['register_username']));
    $data = $req->fetch();
    $req->closeCursor();

    if ($data == null)
    {
      $req = $bdd->prepare('INSERT INTO users_table(username, password) VALUES(:input_username, :input_password)');
      $req->execute(array(
        'input_username' => htmlspecialchars($_POST['register_username']),
        'input_password' => htmlspecialchars($_POST['register_password'])
      ));

      $_SESSION['login_message'] = "successful_register";
    }
    else
    {
      $_SESSION['login_message'] = "incorrect_register";
    }
  }




  if (isset($_SESSION['session_username']))
  {
    header('location:index.php');
  }




  include('section/section_login.php');




  if(isset($_SESSION['login_message']))
  {
    if($_SESSION['login_message'] == "logged_out")
    {
      echo '<p>Vous êtes déconnecté</p>';
    }

    if($_SESSION['login_message'] == "successful_register")
    {
      echo '<p>Nouvel utilisateur inscrit avec succès</p>'; 
    }

    if($_SESSION['login_message'] == "account_deleted")
    {
      echo '<p>Compte supprimé avec succès</p>';
    }

    if($_SESSION['login_message'] == "incorrect_login")
    {
      echo '<p>Nom utilisateur ou mot de passe incorrect</p>';
    }

    if($_SESSION['login_message'] == "incorrect_register")
    {
      echo '<p>Utilisateur déjà inscrit</p>'; 
    }

    unset($_SESSION['login_message']);
  }



  echo '<p><a href="register.php">Register</a></p>';




?>

<!DOCTYPE html>
<html>
    <head>
          <meta charset="utf-8" />
          <title>Login</title>
    </head>
</html>