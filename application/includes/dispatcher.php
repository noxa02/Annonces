<?php
    define('BASE_URL', Url::getBaseUrl());
    $router = new Router();
    
    if($router->constructRoute()) {
        if(isset($_SESSION['user']['login'])) {
            $current_user = new User();
            $conditions = '?login='.$_SESSION['user']['login'];
            $user = XML_Custom::unserialize($current_user->getUsers($conditions));
            $current_user->setUserData($user['user']);
        }
        
        if($router->controller) {
            $view = $router->getViewPath();
            require_once $router->getControllerPath(); 
        }
    } else {
        print 'fail';
    }