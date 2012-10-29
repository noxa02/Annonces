<?php
session_start();

require_once '../settings.php';

if (isset($_SESSION['user'])):
    //$_user->setUserData($_SESSION['user']['login']);
    //$_user->checkUserData($_SESSION['user']['login'], $_SESSION['user']['password']);
endif;

include_once APPLICATION_PATH.'/dispatcher_mvc.php';
?>

<!DOCTYPE html>
<html lang="fr">
<?php 
    if($layouts_['header'] == true): 
        include APPLICATION_PATH . '/layouts/header.layout.php';
    endif; 
?>
    <body>
    <?php 
        if($layouts_['main_nav'] == true): 
            include APPLICATION_PATH . '/layouts/main_nav.layout.php';
        endif; 
    ?>
        <?php 
            if(isset($view_)):
                include $view_;
            endif;
        ?>
     <?php 
        if($layouts_['footer'] == true): 
            include APPLICATION_PATH . '/layouts/footer.layout.php';
        endif; 
    ?>
    </body>
</html>