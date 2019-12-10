<?php

  //	Démarre le système de sessions. Si le visiteur vient d'arriver sur le site, alors un numéro de session est généré pour lui.
  session_start();

  if(isset($_SESSION['session_username']))
  {
    //  Affiche la page de profil si un utilisateur est identifié
    echo '<p>Bonjour ' . $_SESSION['session_username'] .' !</p>';
    include('section/section_delete.php');
    include('section/section_logout.php');
    echo '<p><a href="page_chatbox.php">Go to chatbox</a></p>';
  }
  else
  {
    header('location:index.php');
  }

?>
