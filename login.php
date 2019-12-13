<?php

  session_start();
  require('db_credentials.php');
  require('db_modele.php');

  if(isset($_POST['delete']))
  {
    deleteUser();
  }

  if (isset($_POST['logout']))
  {
    logoutUser();
  }

  if(isset($_POST['register_username']) && isset($_POST['register_password']))
  {
    if($_POST['register_username'] != NULL || $_POST['register_password'] != NULL)
    {
      registerUser();
    }
    else
    {
      $_SESSION['login_message'] = "null_input";
    }
  }

  if (isset($_SESSION['session_username']))
  {
    header('location:profile.php');
  }

  require('section/section_login.php');

?>