<?php 
if(isset($_POST['register-form'])):
	$_userData =  array('name'      => $_POST['name_r'],
					    'firstname' => $_POST['firstname_r'],
					    'login'     => $_POST['login_r'],
						'password'  => $_POST['password_r']
						);

		foreach ($_userData as $key => $value) {
			$_methodName = ucfirst($key);
			$_method = 'set'.ucfirst($key);
			if(method_exists($_user, 'set'.$_methodName)):
				$_user->$_method($value);
			endif;
		}
		//$_user->insertUser();
		UserMapper::save($_user);
if(isset($_FILES['avatar_r']) && $_FILES['avatar_r']['error'] == UPLOAD_ERR_OK):
	resizeAvatar($_FILES['avatar_r'],$_user);
endif;

endif;
