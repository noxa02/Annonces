<?php 

function print_log($vars) {
	print '<pre>';
		print_r($vars);
	print '</pre>';
}

function print_logex($vars) {
	print '<pre>';
		print_r($vars);
	print '</pre>';
	exit();
}

function url_construct($vars) {
	$_server_name = $vars['SERVER_NAME'];
	$_server_port = $vars['SERVER_PORT'];
	$_uri = $vars['REQUEST_URI'];
	$_output = '';

	if(isset($_server_name) && !empty($_server_name) && $_server_name == 'localhost'):
		$_output .= $_server_name;
		if(isset($_server_port) && !empty($_server_port)):
			$_output .= ':'.$_server_port;
		endif;
		$_output .= $_uri;
	elseif($_http_host == 'http' || 'https'):
		$_output .= $_server_name.'://'.$_uri;
	endif;
}

function cutString( $string, $max_length, $separator) {
	if( strlen($string) >= $max_length ) { 
		$string = substr($string, 0, $max_length ); 
		$last_space = strrpos($string, ' ' ); 
		$string = substr($string, 0, $last_space); 

		$string = str_replace("-","<br> -", $string);

		return htmlentities($string,ENT_QUOTES, "UTF-8") . '  ' . $separator;
	}
	
	else
		return htmlentities($string);
}

function resizeAvatar($file, $_user) {
	if(!empty($file)):
	  	if ($file['error'] <= 0):
	    	if ($file['size'] <= 2097152):
	        $avatar = $file['name'];
			$extensionList = array('jpg' => 'image/jpeg', 
								   'jpeg' => 'image/jpeg', 
								   'png' => 'image/png', 
								   'gif' => 'image/gif');
			$extensionListIE = array('jpg' => 'image/pjpg', 
									 'jpeg'=>'image/pjpeg'); 

			$extension = explode('.', $avatar);
			$extension = strtolower($extension[1]);
				if ($extension == 'jpg' 
					|| $extension == 'jpeg' 
						|| $extension == 'pjpg' 
							|| $extension == 'pjpeg' 
								|| $extension == 'gif' 
									|| $extension == 'png'):
					$_avatar = getimagesize($file['tmp_name']);
					if($_avatar['mime'] == $extensionList[$extension]  
						|| $_avatar['mime'] == $extensionListIE[$extension]):
						$_avatarR = imagecreatefrompng($file['tmp_name']);
						$widthAvatar = getimagesize($file['tmp_name']);
						$newWidth = 100;
						$newHeigth = 100;
						$reduce = (($newWidth * 100) / $widthAvatar[0] );
						$newWidth = (($widthAvatar[1] * $reduce)/100 );

						$newAvatar = imagecreatetruecolor($newWidth , $newHeigth);
						imagecopyresampled($newAvatar , $_avatarR, 0, 0, 0, 0, $newWidth, $newHeigth, $widthAvatar[0],$widthAvatar[1]);
						imagedestroy($_avatarR);
						imagepng($newAvatar , UPLOAD_FILES.'/avatar/'.strtolower($_user->getLogin()).'.'.$extension, 9);
					endif;
				endif;
			endif;
		endif;
	endif;
}
