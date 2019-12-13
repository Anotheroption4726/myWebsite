<?php $title = 'Register'; ?>

<?php ob_start(); ?>

  <p>
    <form method="post" action="login.php">
      New username: <input type="text" name="register_username" required /><br>
      New password: <input type="password" name="register_password" required /><br>
      <input type="submit" value="Register" />
    </form>
  </p>
  <p><a href="login.php">Login</a></p>  

<?php $body_content = ob_get_clean(); ?>

<?php require('./section/template.php'); ?>