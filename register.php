<?php

  session_start();

  if (isset($_SESSION['session_username']))
  {
    header('location:profile.php');
  }

  require('section/section_register.php');

?>
