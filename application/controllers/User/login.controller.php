<?php
    include_once realpath(dirname(__FILE__).'/../../bootstrap.php'); 
    $document_title = ' | Connexion';
    if(isset($_POST['login']) && isset($_POST['password'])) {
        
        $user = new User();
        $user->setUserData($_POST); 
        $user->destroySessionUser();
        $user->initSessionUser();
        setcookie('login', $user->getLogin());
        if(isset($_SESSION['user']['login']) && !empty($_SESSION['user']['login'])) {
            print 'ok';
        } else print 'fail';
    }
exit;