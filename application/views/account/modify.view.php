<div id="content">
	<h2>Modification</h2>
		<form action="#" method="post" class="register-form" enctype="multipart/form-data">
			<div class="row">
				<label for="login_m"> Identifiant :</label>
				<input type="text" id="login_m" name="login_m" value="<?php print $_user->getLogin(); ?>">
			</div>
			<div class="row">
				<label for="password_m"> Mot de passe : </label>
				<input type="password" id="password_m" name="password_m">
			</div>
			<div class="row">
				<label for="password_confirm_m"> Confirmation : </label>
				<input type="password" id="password_confirm_m" name="password_confirm_m">
			</div>
			<div class="row">
				<label for="name_m"> Nom : </label>
				<input type="text" id="name_m" name="name_m" value="<?php print $_user->getName(); ?>">
			</div>
			<div class="row">
				<label for="firstname_m">Prénom : </label>
				<input type="text" id="firstname_m" name="firstname_m" value="<?php print $_user->getFirstname(); ?>">
			</div>
			<div class="row">
				<label for="avatar_m"> Avatar :</label>
				<input type="file" id="avatar_m" name="avatar_m">
			</div>
			<div class="btn-holder">
				<span class="note">* Champs obligatoires</span>
				<input type="submit" name="modify-account-form" value="Confirmer">			
			</div>
		</form>	
</div>
<div id="sidebar">
	<h2>Votre Pub</h2> 
</div>