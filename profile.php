<?php

  session_start();
  require('model/db_model.php');

  if (isset($_POST['login_username']) && isset($_POST['login_password']))
  {
    if($_POST['login_username'] != NULL || $_POST['login_password'] != NULL)
    {
      loginUser($_POST['login_username'], $_POST['login_password']);
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

  $loggedUserName = getUserName($_SESSION['session_id']);

  require('view/profileView.php');