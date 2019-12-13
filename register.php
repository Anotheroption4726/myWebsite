<?php

  session_start();

  if (isset($_SESSION['session_id']))
  {
    header('location:profile.php');
  }

  require('view/registerView.php');
