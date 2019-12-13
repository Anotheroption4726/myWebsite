<?php

  session_start();
  require('db_credentials.php');
  require('db_model.php');

  if(!isset($_SESSION['session_id']))
  {
    header('location:login.php');
  }

  if(isset($_POST['message_input']))
  {
    postMessage();
  }

  $req = getMessages();

  require('./section/chatboxView.php');

  $req->closeCursor();