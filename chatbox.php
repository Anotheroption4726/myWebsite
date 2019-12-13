<?php

  session_start();
  require('db_credentials.php');
  require('db_modele.php');

  if(!isset($_SESSION['session_username']))
  {
    header('location:login.php');
  }

  if(isset($_POST['message_input']))
  {
    postMessage();
  }

  $req = getMessages();

  require('./section/section_chatbox.php');

  $req->closeCursor();

?>