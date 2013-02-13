<?php 
    $layouts = array(
      'header'      => true,
      'navbar'      => true,
      'connexion'   => true,
      'footer'      => true,
    );
    
    if(isset($current_user) && !$current_user->isAuthentified()) {
        header('Location:'.BASE_URL);
    }
    
    if($router->id) {
        if(!isset($current_user)) {
            $user = new User();
            $user->setId($_GET['id']);
            $user->initUserData();
        } else {
            $user = $current_user;
        }
    }