<?php
    $index = Url::getBaseUrl();
    if(isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        session_destroy();
        header('Location:'.$index);
    }