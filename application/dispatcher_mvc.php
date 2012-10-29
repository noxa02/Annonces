<?php
try {
    if(isset($_GET['m'])): //method
        
        $controller = $view = strtolower($_GET['p']);
        $extController = '.controller.php';
        $extView = '.view.php';
        
        if(isset($_GET['a'])): //action
            
            $action = $_GET['a'];
        
            if(is_readable(APPLICATION_PATH . '/controllers/' . $controller . '/' . $action . $extController)
                    && is_readable(APPLICATION_PATH . '/views/' . $controller . '/' . $action . $extView)):
                
                $controller_ = APPLICATION_PATH . '/controllers/' . $controller . '/' . $action . $extController;
                $view_ = APPLICATION_PATH . '/views/' . $view . '/' . $action . $extView;
                
            else:
                //throw new Exception('Impossible d\'accéder au controller : ' . $_controller . ', action : ' . $_action . ' ', 1);
            endif;
        endif;
        
    else: //default view : controller --> home page
        
        $controller_ = APPLICATION_PATH . '/controllers/default/default.controller.php';
        $view_ = APPLICATION_PATH . '/views/default/default.view.php';
        
        if(!is_readable($controller_)
                && !is_readable($view_)):
            throw new Exception('Impossible d\'acc�der au controller : '.$controller_, 1);    
        endif;
        
    endif;
    
} catch (Exception $e) {
    print '<strong>' . $e->getMessage() . '</strong>';
}

if(isset($controller_)):
    include($controller_); 
else:           
    $view_ = APPLICATION_PATH . '/views/404.view.php';
endif;

