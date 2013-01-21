<?php
require '../application/bootstrap.php';

$member_ = new Member();

if (isset($_SESSION['user'])) { 
    $member_->setUserData($_SESSION['user']['login']);
    $member_->checkUserData($_SESSION['user']['login'], $_SESSION['user']['password']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="fr">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <link rel="icon" type="image/png" href="images/favicon24x24.png" />
        <script type="text/javascript" src="js/jquery.1.8.1.js"></script>
        <script type="text/javascript" src="js/functions.js"></script>
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