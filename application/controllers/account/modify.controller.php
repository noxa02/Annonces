<?php 
if(isset($_POST['modify-account-form'])):
	foreach ($_POST as $key => $value):
		if(substr($key, -2,2) == '_m'):
			if($key != 'password_confirm_m' && $key != 'avatar_m'):
				$userDataModified[str_replace('_m','',$key)] = $value;
			endif;
		endif;
	endforeach;
	$oldLogin = $_user->getLogin();
	$_user->updateUserData($userDataModified);
	$_user->initSessionUser($_user->getLogin(),$_user->getPassword());
	print $oldLogin.' '.$_user->getLogin();
	$_user->setAvatarName($oldLogin);
if(isset($_FILES['avatar_m']) && $_FILES['avatar_m']['error'] == UPLOAD_ERR_OK):
	resizeAvatar($_FILES['avatar_m'],$_user);
endif;

endif;

