<?php
session_start();

include_once '../settings.php';
include_once APPLICATION_PATH.'/includes/template.php';
include_once APPLICATION_PATH.'/includes/autoloader.php';
include_once APPLICATION_PATH.'/dispatcher_mvc.php';


if (isset($_SESSION['user'])) {
    //$_user->setUserData($_SESSION['user']['login']);
    //$_user->checkUserData($_SESSION['user']['login'], $_SESSION['user']['password']);
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <title>Petites Annonces</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="css/all.css" rel="stylesheet">
    </head>
    <body>
    <?php 
        if(isset($layouts_['main_nav']) && $layouts_['main_nav'] == true) {
            include APPLICATION_PATH . '/layouts/main_nav.layout.php';
        }
    ?>
        <?php 
            if(isset($view_)) {
                include $view_;
            }
        ?>
     <?php
        if(isset($layouts_['footer']) && $layouts_['footer'] == true) {
            include APPLICATION_PATH . '/layouts/footer.layout.php';
        }
    ?>
    </body>
</html>