<!DOCTYPE html>
<html>
    <head>
          <meta charset="utf-8" />
          <title>Profile</title>
    </head>
    <body>

    	<?php
    		echo '<p>Bonjour ' . $_SESSION['session_username'] .' !</p>';
    	?>

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
      
    </body>
</html>