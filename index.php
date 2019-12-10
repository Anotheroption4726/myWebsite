<?php

  //  Connection à la base de données
  session_start();
  include('db_connect.php');


  if(isset($_SESSION['session_username']))
  {
    if (isset($_POST['logout']))
    {
        //  Detruit la session
        unset($_SESSION);
        session_destroy();
    }
    elseif(isset($_POST['delete']))
    {
        //  Requète de suppression d'utilisateur
        $req = $bdd->prepare('DELETE FROM users_table WHERE username = :delete_user');
        $req->execute(array('delete_user' => $_SESSION['session_username']));

        //  Fermeture du curseur d'analyse des résultats
        $req->closeCursor();

        unset($_SESSION);
        session_destroy();
    }
    else
    {
      //  Envoie vers la page de profil si un utilisateur est identifié
      header('location:page_user.php');
    }
  }

  //  Affiche la page de login
  include('section/section_login.php');


  if (isset($_POST['login_username']) && isset($_POST['login_password']))
  {
    //  Requète SQL récupérant dans la table l'username et le password envoyé par le formulaire
    $req = $bdd->prepare('SELECT username, password FROM users_table WHERE username = :input_username AND password = :input_password');
    $req->execute(array('input_username' => $_POST['login_username'], 'input_password' => $_POST['login_password']));
    $data = $req->fetch();

    if ($data != null)
    {
      //  Affiche un message de bienvenue ainsi qu'un bouton de logout si les informations sont bonnes
      $_SESSION['session_username'] = $data['username'];

      //  Fermeture du curseur d'analyse des résultats
      $req->closeCursor();

      header('location:page_user.php');
    }
    else
    {
      //  Affiche un message d'erreur si les informations ne sont pas bonnes
      echo '<p>Nom utilisateur ou mot de passe incorrect</p>';
    }

    //  Fermeture du curseur d'analyse des résultats
    $req->closeCursor();
  }


  if (isset($_POST['logout']))
  {
      //  Affiche un message de déconnection si jamais l'utilisateur s'est deconnecté
      echo '<p>Vous êtes déconnecté</p>';
  }


  if(isset($_POST['delete']))
  {
    //  Affiche un message de suppression si jamais l'utilisateur a supprimé son compte
    echo '<p>Compte supprimé avec succès</p>';
  }


  echo '<p>Veuillez entrer un nom utilisateur et un mot de passe</p>';

  //  Affichage du lien vers la page d'inscription
  echo '<p><a href="page_register.php">Register</a></p>';

?>

<!DOCTYPE html>
<html>
    <head>
          <meta charset="utf-8" />
          <title>Login</title>
    </head>
</html>
