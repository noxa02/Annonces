<?php 
//$form = new Form_connexion();

if(isset($_POST['submit-connexion'])):
	if($_user->existUser($_POST['login_c'])):
		$_user->initSessionUser($_POST['login_c'],$_POST['password_c']);
		if(!empty($_SESSION['user'])):
			header('Location:'.PUBLIC_PATH_LOCATION.'/index.php');
			exit();
		endif;
	else: 
		print 'Echec de la connexion !';
	endif;
endif;