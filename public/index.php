<?php
session_start();

require_once '../settings.php';

if (isset($_SESSION['user'])):
    //$_user->setUserData($_SESSION['user']['login']);
    //$_user->checkUserData($_SESSION['user']['login'], $_SESSION['user']['password']);
endif;
// test
// Dispatcher MVC
try {
    if (isset($_GET['p'])):
        $controller = strtolower($_GET['p']);
        $view = strtolower($_GET['p']);
        $extController = '.controller.php';
        $extView = '.view.php';
        if (isset($_GET['a'])):
            $action = $_GET['a'];
            if (is_readable(APPLICATION_PATH . '/controllers/' . $controller . '/' . $action . $extController)
                    && is_readable(APPLICATION_PATH . '/views/' . $controller . '/' . $action . $extView)):
                $_controller = APPLICATION_PATH . '/controllers/' . $controller . '/' . $action . $extController;
                $_view = APPLICATION_PATH . '/views/' . $view . '/' . $action . $extView;
            else:
                //throw new Exception('Impossible d\'accéder au controller : ' . $_controller . ', action : ' . $_action . ' ', 1);
            endif;
        endif;
    else:
        $_controller = APPLICATION_PATH . '/controllers/home/home.controller.php';
        $_view = APPLICATION_PATH . '/views/home/home.view.php';
        if (!is_readable($_controller)
                && !is_readable($_view)):
        //throw new Exception('Impossible d\'acc�der au controller : '.$_controller, 1);    
        endif;
    endif;
} catch (Exception $e) {
    print '<strong>' . $e->getMessage() . '</strong>';
}

if (isset($_controller)):
//include($_controller); 
else:
    $_view = APPLICATION_PATH . '/views/404.view.php';
endif;
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Petites Annonces</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <!-- <link rel="stylesheet" type="text/css" href="css/all.css"> -->
    </head>
    <body>
        <div class="navbar navbar-fixed-top">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>P
                    </a>
                    <a class="brand" href="#"> Site d'Annonces </a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li class="active"><a href="#"> Accueil </a></li>
                            <li><a href="#about">A Propos</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
          <div class="page-header">
              Titre
          </div>
            <form class="form-search">
                <div class="input-prepend">
                  <button class="btn btn-primary" type="submit">Recherche</button>
                  <input type="text" class="search-query">
                </div>
            </form>
          <div class="row">
            <div class="span12">...</div>
          </div>
          <div class="row">
            <div class="span2">...</div>
            <div class="span2">...</div>
            <div class="span2">...</div>
            <div class="span2">...</div>
            <div class="span2">...</div>
            <div class="span2">...</div>
            <div class="span2">...</div>
            <div class="span2">...</div>
            <div class="span2">...</div>
            <div class="span2">...</div>
            <div class="span2">...</div>
            <div class="span2">...</div>
          </div>
          <div class="row">
            <div class="span4">...</div>
            <div class="span8">...</div>
          </div>
          <div class="row">
            <div class="span9">...</div>
            <div class="span3">...</div>
          </div>
        </div>

        <script type="text/javascript" src="js/jquery.1.8.1.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
    </body>
</html>