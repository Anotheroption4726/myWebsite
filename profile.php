<?php

  session_start();
  require('./model/db_credentials.php');
  require('./model/db_model.php');

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

  if (!isset($_SESSION['session_id']))
  {
    header('location:login.php');
  }

  $loggedUserName = getUserName();

  require('view/profileView.php');