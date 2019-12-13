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


  

  function deleteUser($deleteUserId)
  {
  	$bdd = dbconnect();

  	$req = $bdd->prepare('DELETE FROM users_table WHERE id = :delete_id');
    $req->execute(array('delete_id' => $deleteUserId));
    $req->closeCursor();

    unset($_SESSION);
    session_destroy();

    $_SESSION['login_message'] = "account_deleted";
  }


  function logoutUser()
  {
  	$bdd = dbconnect();

  	unset($_SESSION);
    session_destroy();

    $_SESSION['login_message'] = "logged_out";
  }


  function registerUser($newUsername, $newUserPassword)
  {
  	$bdd = dbconnect();

  	$req = $bdd->prepare('SELECT username FROM users_table WHERE username = :input_username');
    $req->execute(array('input_username' => $newUsername));
    $data = $req->fetch();
    $req->closeCursor();

    if ($data == null)
    {
      $req = $bdd->prepare('INSERT INTO users_table(username, password) VALUES(:input_username, :input_password)');
      $req->execute(array(
        'input_username' => htmlspecialchars($newUsername),
        'input_password' => htmlspecialchars($newUserPassword)
      ));

      $_SESSION['login_message'] = "successful_register";
    }
    else
    {
      $_SESSION['login_message'] = "incorrect_register";
    }
  }


  function loginUser($loginUsername, $loginUserPassword)
  {
  	$bdd = dbconnect();

    $req = $bdd->prepare('SELECT id FROM users_table WHERE username = :input_username AND password = :input_password');
    $req->execute(array('input_username' => $loginUsername, 'input_password' => $loginUserPassword));
    $data = $req->fetch();
    $req->closeCursor();

    if ($data != null)
    {
      $_SESSION['session_id'] = $data['id'];
    }
    else
    {
      $_SESSION['login_message'] = "incorrect_login";
    }
  }


  function getUserName($getUserId)
  {
    $bdd = dbconnect();

    $req = $bdd->prepare('SELECT username FROM users_table WHERE id = :session_id');
    $req->execute(array('session_id' => $getUserId));
    $data = $req->fetch();
    $req->closeCursor();

    return $data['username'];
  }


  function postMessage($messageSenderId, $messageContent)
  {
  	$bdd = dbconnect();

  	$req = $bdd->prepare('INSERT INTO messages_table(sender_id, message, posting_date_time) VALUES(:message_sender, :message_content, NOW())');

  	$req->execute(array(
  	    'message_sender' => $messageSenderId,
  	    'message_content' => htmlspecialchars($messageContent)
  	   	));

  	$req->closeCursor();
  }


  function getMessages()
  {
    $bdd = dbconnect();

  	$req = $bdd->query('SELECT sender_id, message, DATE(posting_date_time) AS posting_day, HOUR(posting_date_time) AS posting_hour, MINUTE(posting_date_time) AS posting_minute FROM messages_table ORDER BY ID');

  	return $req;
  }


  function dbconnect()
  {
    try
    {
      $bdd = new PDO('mysql: host='.C_HOST.'; dbname='.C_DBNAME.'; charset=utf8', C_LOGIN, C_PASSWORD, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }

    return $bdd;
  }

?>