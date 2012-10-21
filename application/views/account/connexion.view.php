<?php 
if(empty($_SESSION)):
	
	//print $form;
?>
	<div class="form-account">

		<form action="index.php?p=account&a=connexion" method="post">
			<label for="login_c"></label>
				<input type="text" id="login_c" name="login_c" placeholder="Login">
			<label for="password_c"></label>
				<input type="password" name="password_c" placeholder="Mot de passe">

			<input type="submit" value="Connexion" name="submit-connexion">
		</form>	

		<a href="index.php?p=account&a=register" target="_blank"> Pas encore inscrit ? </a>	

		<?php  if(isset($message)) print '<p>'.$message.'</p>'; ?>
	</div>
<?php 

else:
?>
	<div class="form-account">
		<?php 
		if(file_exists(UPLOAD_FILES.'/avatar/'.$_user->getLogin().'.png')):
		?>
			<img src="<?php print '../'.AVATAR_PATH.'/'.strtolower($_user->getLogin()).'.png'; ?>" alt="Avatar <?php print $_user->getLogin(); ?>" width="100" height="100">
		<?php
		endif;
		?>
		<p> Bonjour <strong><?php print $_user->getLogin(); ?></strong> <span class="user-connect"> </span> </p>
 	</div>
<?php
endif;


