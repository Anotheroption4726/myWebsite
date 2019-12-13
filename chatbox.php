<?php

  session_start();
  require('model/db_model.php');

  if(!isset($_SESSION['session_id']))
  {
    header('location:login.php');
  }

  if(isset($_POST['message_input']))
  {
    postMessage($_SESSION['session_id'], $_POST['message_input']);
  }


  $loggedUserId = $_SESSION['session_id'];

  $req = getMessages();

  require('view/chatboxView.php');

  $req->closeCursor();