<?php

  //	Démarre le système de sessions. Si le visiteur vient d'arriver sur le site, alors un numéro de session est généré pour lui.
  session_start();


  if(!isset($_SESSION['session_username']))
  {
    //  Envoie vers la page de profil si un utilisateur est identifié
    header('location:page_user.php');
  }


  //  __Connection à la base de données__
  include('db_connect.php');


  //  Insertion d'un nouveau message
  if(isset($_POST['message_input']))
  {
    $req = $bdd->prepare('INSERT INTO messages_table(sender, message, posting_date_time) VALUES(:message_sender, :message_content, NOW())');
    $req->execute(array(
        'message_sender' => $_SESSION['session_username'],
      	'message_content' => htmlspecialchars($_POST['message_input'])
    	));
    $req->closeCursor();
  }

?>


<!DOCTYPE html>
<html>
    <head>
          <meta charset="utf-8" />

          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
          <link href="style/chatbox_style.css" type="text/css" rel="stylesheet">

          <title>Chatbox</title>
    </head>

    <body>
      <div class="container">
        <!--DEBUT DU CHAT--->
        <div class="row">
          <div class="col-12 msg_history_display">
              <!--
              -->
              <div class="msg_history">
                <?php
                  $reponse = $bdd->query('SELECT sender, message, DATE(posting_date_time) AS posting_day, HOUR(posting_date_time) AS posting_hour, MINUTE(posting_date_time) AS posting_minute FROM messages_table ORDER BY ID');

                  while ($donnees = $reponse->fetch())
                  {
                    if ($donnees['sender'] == $_SESSION['session_username'])
                    {
                      echo '<div class="outgoing_msg">
                             <div class="sent_msg">
                               <p style="overflow-wrap: break-word;">'.$donnees['message'].'</p>
                               <span class="time_date">'.$donnees['posting_hour'].':'.$donnees['posting_minute'].' | '.$donnees['posting_day'].'</span>
                              </div>
                             </div>';
                    }
                    else
                    {
                      echo '<div class="incoming_msg">
                              <div class="incoming_msg_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                              <div class="received_msg">
                                <div class="received_withd_msg">
                                  <p style="overflow-wrap: break-word;">'.$donnees['message'].'</p>
                                  <span class="time_date">'.$donnees['posting_hour'].':'.$donnees['posting_minute'].' | '.$donnees['posting_day'].'</span>
                                </div>
                              </div>
                            </div>';
                    }
                  }
                  $reponse->closeCursor();
                ?>
              </div>
              <!--
              -->
          </div>
        </div>
          <form class="row" method="post" action="page_chatbox.php">
            <div class="col-10 send_msg_input_column">
              <textarea class="text_area send_msg_input" placeholder="Type a message" name="message_input" required></textarea>
            </div>
            <div class="col-2 send_msg_button_column">
              <!-- !!! Change type from "submit" to "button" when using javascript !!! -->
              <button class="send_msg_button" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
            </div>
          </form>
        <!--FIN DU CHAT--->
      </div>


      <!--Retour à la page d'index--->
      <div>
        <a href="index.php">Back to profile</a>
      </div>


      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    </body>
</html>
