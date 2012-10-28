<?php
session_start();

require_once '../settings.php';

if (isset($_SESSION['user'])):
    //$_user->setUserData($_SESSION['user']['login']);
    //$_user->checkUserData($_SESSION['user']['login'], $_SESSION['user']['password']);
endif;

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
        <link href="css/all.css" rel="stylesheet">
        <!-- <link rel="stylesheet" type="text/css" href="css/all.css"> -->
    </head>
    <body>
        <div class="navbar navbar-fixed-top nav-top-custom">
            <div class="navbar-inner">
                <div class="container-fluid">
                    <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>P
                    </a>
                    <a class="brand" href="#"> A Simply Trade </a>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li class="active"><a href="#"> Accueil </a></li>                  
                            <li><a href="#about">A Propos</a></li>
                            <li><a href="?p=inscription">Inscription</a></li>
                            <li><a href="#contact">Contact</a></li>
                            <li class="divider-vertical"></li>                          
                            <ul class="nav">
                                <div class="pull-left padding-top5 padding-bottom5">
                                    <img class="thumbnail" src="http://placehold.it/50x50" alt="" width="50" height="50">
                                </div>
                                <div class="btn-group pull-left padding-left5 padding-top15">
                                  <a class="btn" href="#"><i class="icon-user"></i> Mon Compte </a>
                                  <a class="btn dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                                  <ul class="dropdown-menu">
                                    <li><a href="#"><i class="icon-pencil"></i> Modifier mon compte </a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="icon-off"></i> Se deconnecter </a></li>
                                  </ul>
                                </div>
                            </ul>
                            <li class="divider-vertical"></li>
                        </ul>
                        <form class="navbar-search form-search pull-right padding-top15">
                            <div class="input-prepend">
                              <button class="btn btn-primary" type="submit">Recherche <i class="icon-search icon-white"></i></button>
                              <input type="text" class="search-query">
                            </div>
                        </form>                        
                    </div>
                </div>
            </div>
        </div>
        <header id="header">
         <div class="container">
           <h1>Titre primaire</h1>
           <p class="lead">
               Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent rhoncus feugiat facilisis. 
               Morbi vulputate condimentum interdum. In in lorem congue felis eleifend feugiat vel et libero.
           </p>
         </div>
       </header>
        <div class="container">
            <div class="page-header">
                <h2>Titre secondaire</h2>
            </div>
            <div class="row">
              <div class="span12">
                Level 1 of column
                <div class="row">
                  <div class="span6">Level 2</div>
                  <div class="span6">Level 2</div>
                </div>
              </div>
            </div>
        </div>

        <script type="text/javascript" src="js/jquery.1.8.1.js"></script>
        <script src="bootstrap/js/bootstrap.js"></script>
    </body>
</html>