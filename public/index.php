<?php 
    session_start();  
    ini_set('display_errors','on');

    require_once '../settings.php';
    require_once APPLICATION_PATH.'/includes/template.php';
    require_once APPLICATION_PATH.'/includes/autoload.php';


    $_db = PDO_Singleton::getInstance();
    $_uMapper = new UserMapper();
    $_user = new User();

    if(isset($_SESSION['user'])):
        $_user->setUserData($_SESSION['user']['login']);
        $_user->checkUserData($_SESSION['user']['login'],$_SESSION['user']['password']);
    endif;

    // Dispatcher MVC
    try {
        if(isset($_GET['p'])):
            $controller = strtolower($_GET['p']);
            $view = strtolower($_GET['p']);
            $extController = '.controller.php';
            $extView = '.view.php';
            if(isset($_GET['a'])):
                $action = $_GET['a']; 
                if(is_readable(APPLICATION_PATH.'/controllers/'.$controller.'/'.$action.$extController) 
                    && is_readable(APPLICATION_PATH.'/views/'.$controller.'/'.$action.$extView)):
                    $_controller = APPLICATION_PATH.'/controllers/'.$controller.'/'.$action.$extController;
                    $_view = APPLICATION_PATH.'/views/'.$view.'/'.$action.$extView;
                else:
                    throw new Exception('Impossible d\'acc√©der au controller : '.$_controller.', action : '.$_action.' ', 1);    
                endif;                
            endif;
        else:
            $_controller = APPLICATION_PATH.'/controllers/home/home.controller.php';
            $_view = APPLICATION_PATH.'/views/home/home.view.php';
            if(!is_readable($_controller) 
                && !is_readable($_view)):
                throw new Exception('Impossible d\'accéder au controller : '.$_controller, 1);    
            endif;  
        endif;
    } catch (Exception $e) {
                print '<strong>'.$e->getMessage().'</strong>';
    }

if(isset($_controller)): 
    include($_controller); 
else:
    $_view = APPLICATION_PATH.'/views/404.view.php';
endif;
?>
                            
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Petites Annonces</title>
    <link rel="stylesheet" type="text/css" href="css/all.css">
    <script type="text/javascript" src="js/jquery.1.8.1.js"></script>
</head>
<body>
    <div id="wrapper">
        <div class="header-container">
            <div id="header">
                <div class="logo">
                    <a href="index.php">
                        <img src="images/twitter_logo.png" alt="Logo" />
                    </a>
                </div>
                <div class="header-content">
                    <h3>Chat/Twitter</h3>
                </div>
                <?php include(APPLICATION_PATH.'/controllers/account/connexion.controller.php'); ?>
                <?php include(APPLICATION_PATH.'/views/account/connexion.view.php'); ?>
            </div>
        </div>
        <div id="nav" class="clearfloat">
            <?php include(APPLICATION_PATH.'/views/menu.view.php'); ?>
        </div>
        <div id="main">
            <?php 
                include $_view;
            ?>
        </div>
        <div id="footer" class="clearfloat">
            
        </div>
    </div>
</body>
</html>