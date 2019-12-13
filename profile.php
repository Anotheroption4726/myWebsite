<?php

  session_start();
  require('db_credentials.php');
  require('db_modele.php');

  if (isset($_POST['login_username']) && isset($_POST['login_password']))
  {
    if($_POST['login_username'] != NULL || $_POST['login_password'] != NULL)
    {
      loginUser();
    }
    else
    {
      $_SESSION['login_message'] = "null_input";
    }
  }

  if (!isset($_SESSION['session_username']))
  {
    header('location:login.php');
  }

  require('./section/section_profile.php');

?>