<?php 
    /**
     * Global variables to connect the database.
     */
    global $PARAM_host,$PARAM_port,$PARAM_user,$PARAM_dbname,$PARAM_password; 
    $PARAM_host = 'localhost';
    $PARAM_port = '8889';
    $PARAM_user = 'root'; 
    $PARAM_dbname = 'asimpletrade'; 
    $PARAM_password = 'root'; 

    /**
     * Constants to multiples path.
     */
    define('PATH_ROOT', dirname(__FILE__));
    define("APPLICATION_PATH", PATH_ROOT . '/application');
    define("PUBLIC_PATH", PATH_ROOT . '/public');
    define("UPLOAD_FILES", PATH_ROOT . '/data/upload');
