<?php $title = 'Profile'; ?>

<?php ob_start(); ?>

  <p>Bonjour <?= $loggedUserName ?>!</p>

  <p>
    <form method="post" action="login.php">
      <input type="submit" name="delete" value="Delete Account" />
    </form>
  </p>

  <p>
    <form method="post" action="login.php">
      <input type="submit" name="logout" value="Logout" />
    </form>
  </p>
      
  <p><a href="chatbox.php">Go to chatbox</a></p>

<?php $body_content = ob_get_clean(); ?>

<?php require('./section/template.php'); ?>