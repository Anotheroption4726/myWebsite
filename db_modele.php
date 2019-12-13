<?php

  function deleteUser()
  {
  	require('db_connect.php');

  	$req = $bdd->prepare('DELETE FROM users_table WHERE username = :delete_user');
    $req->execute(array('delete_user' => $_SESSION['session_username']));
    $req->closeCursor();

    unset($_SESSION);
    session_destroy();

    $_SESSION['login_message'] = "account_deleted";
  }


  function logoutUser()
  {
  	require('db_connect.php');

  	unset($_SESSION);
    session_destroy();

    $_SESSION['login_message'] = "logged_out";
  }


  function registerUser()
  {
  	require('db_connect.php');

  	$req = $bdd->prepare('SELECT username FROM users_table WHERE username = :input_username');
    $req->execute(array('input_username' => $_POST['register_username']));
    $data = $req->fetch();
    $req->closeCursor();

    if ($data == null)
    {
      $req = $bdd->prepare('INSERT INTO users_table(username, password) VALUES(:input_username, :input_password)');
      $req->execute(array(
        'input_username' => htmlspecialchars($_POST['register_username']),
        'input_password' => htmlspecialchars($_POST['register_password'])
      ));

      $_SESSION['login_message'] = "successful_register";
    }
    else
    {
      $_SESSION['login_message'] = "incorrect_register";
    }
  }


  function loginUser()
  {
  	require('db_connect.php');

  	$req = $bdd->prepare('SELECT username, password FROM users_table WHERE username = :input_username AND password = :input_password');
    $req->execute(array('input_username' => $_POST['login_username'], 'input_password' => $_POST['login_password']));
    $data = $req->fetch();
    $req->closeCursor();

    if ($data != null)
    {
      $_SESSION['session_username'] = $data['username'];
    }
    else
    {
      $_SESSION['login_message'] = "incorrect_login";
    }
  }


  function postMessage()
  {
  	require('db_connect.php');

	$req = $bdd->prepare('INSERT INTO messages_table(sender, message, posting_date_time) VALUES(:message_sender, :message_content, NOW())');

	$req->execute(array(
	    'message_sender' => $_SESSION['session_username'],
	    'message_content' => htmlspecialchars($_POST['message_input'])
	   	));

	$req->closeCursor();
  }


  function getMessages()
  {
  	require('db_connect.php');

  	$req = $bdd->query('SELECT sender, message, DATE(posting_date_time) AS posting_day, HOUR(posting_date_time) AS posting_hour, MINUTE(posting_date_time) AS posting_minute FROM messages_table ORDER BY ID');

  	return $req;
  }
  

?>