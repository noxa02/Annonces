<?php
    
try {
    if(isset($_GET['m'])) { //method
        
        $controller = $view = strtolower($_GET['m']);
        $extController = '.controller.php';
        $extView = '.view.php';

        if(isset($_GET['a'])) { //action
  
            $action = $_GET['a'];
            
            if(is_readable(APPLICATION_PATH . '/controllers/' . ucfirst($controller) . '/' . $action . $extController)) {  

                $controller_ = APPLICATION_PATH . '/controllers/' . ucfirst($controller) . '/' . $action . $extController;
              
            }
 
            if(is_readable(APPLICATION_PATH . '/views/' . ucfirst($view) . '/' . $action . $extView)) { 

                $view_ = APPLICATION_PATH . '/views/' . ucfirst($view) . '/' . $action . $extView;
               
            }
            
        }
        
    } else { //default view : controller --> home page
            
        $controller_ = APPLICATION_PATH . '/controllers/default/default.controller.php';
        $view_ = APPLICATION_PATH . '/views/default/default.view.php';
        
//        if(!is_readable($controller_)
//                && !is_readable($view_)):
//            throw new Exception('Impossible d\'acceder au controller : '.$controller_, 1);    
//        endif;
        
    }
    
} catch (Exception $e) {
    
    print '<strong>' . $e->getMessage() . '</strong>';
}

if(isset($controller_)) {
    
    include_once($controller_); 
} else {        
    
    $view_ = APPLICATION_PATH . '/views/common/404.view.php';
}

