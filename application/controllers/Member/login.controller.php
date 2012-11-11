<?php
if(isset($_POST['login_c'])) {
    
    include_once '../../../settings.php';
    include_once APPLICATION_PATH.'/includes/template.php';
    include_once APPLICATION_PATH.'/includes/autoloader.php';
    
    $member_ = new Member();
	if($member_->existUser($_POST['login_c'])) {
        
        $member_->setUserData($_POST['login_c']);
		$member_->initSession();
        
        print_log($member_);
        print_log($_POST);
        print_log($_COOKIE);
        
        if(isset($_POST['remember_me_c']) && $_POST['remember_me_c'] === true) {
            $member_->initCookies();
        } else {
            $member_->destroyCookies();
        }
    }
}
    $layouts_ = array(
          'main_nav'    => true,
          'connexion'   => true,
          'footer'      => true,
        );