<?php

  session_start();
  require('model/db_model.php');

  if(isset($_POST['delete']))
  {
    deleteUser($_SESSION['session_id']);
  }

  if (isset($_POST['logout']))
  {
    logoutUser();
  }

  if(isset($_POST['register_username']) && isset($_POST['register_password']))
  {
    if($_POST['register_username'] != NULL || $_POST['register_password'] != NULL)
    {
      registerUser($_POST['register_username'], $_POST['register_password']);
    }
    else
    {
      $_SESSION['login_message'] = "null_input";
    }
  }

  if (isset($_SESSION['session_id']))
  {
    header('location:profile.php');
  }

  require('view/loginView.php');