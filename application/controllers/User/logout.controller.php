<?php
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        session_destroy();
        $current_user->destroySessionUser();
        header('Location:'.BASE_URL);
    }