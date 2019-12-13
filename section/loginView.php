<?php $title = 'Login'; ?>

<?php ob_start(); ?>

	<p>
	    <form method="post" action="profile.php">
	  		Username: <input type="text" name="login_username" required /><br>
	  		Password: <input type="password" name="login_password" required /><br>
	  		<input type="submit" value="Login" />
		</form>
	</p>

	<?php
		
			if(isset($_SESSION['login_message']))
  			{
			    if($_SESSION['login_message'] == "logged_out")
			    {
			      echo '<p>Vous êtes déconnecté</p>';
			    }

			    if($_SESSION['login_message'] == "null_input")
			    {
			      echo '<p>Vous n\'avez pas saisi de nom utilisateur ou de mot de passe</p>'; 
			    }

			    if($_SESSION['login_message'] == "successful_register")
			    {
			      echo '<p>Nouvel utilisateur inscrit avec succès</p>'; 
			    }

			    if($_SESSION['login_message'] == "account_deleted")
			    {
			      echo '<p>Compte supprimé avec succès</p>';
			    }

			    if($_SESSION['login_message'] == "incorrect_login")
			    {
			      echo '<p>Nom utilisateur ou mot de passe incorrect</p>';
			    }

			    if($_SESSION['login_message'] == "incorrect_register")
			    {
			      echo '<p>Utilisateur déjà inscrit</p>'; 
			    }

			    unset($_SESSION['login_message']);
  			}

		?>
		<p><a href="register.php">Register</a></p>

<?php $body_content = ob_get_clean(); ?>

<?php require('./section/template.php'); ?>