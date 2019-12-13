<?php

  try
  {
    $bdd = new PDO('mysql: host='.C_HOST.'; dbname='.C_DBNAME.'; charset=utf8', C_LOGIN, C_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  }
  catch (Exception $e)
  {
    die('Erreur : ' . $e->getMessage());
  }

?>
