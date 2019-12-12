<?php

  //  __Connection à la base de données__
  //  Adresse: localhost
  //  Nom: myWebsite
  //  Login: root
  //  Password:

  const C_HOST = 'localhost';
  const C_DBNAME = 'myWebsite';
  const C_LOGIN = 'root';
  const C_PASSWORD = '';

  try
  {
    $bdd = new PDO('mysql: host='.C_HOST.'; dbname='.C_DBNAME.'; charset=utf8', C_LOGIN, C_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch (Exception $e)
  {
    die('Erreur : ' . $e->getMessage());
  }

?>
