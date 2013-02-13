<?php 
    /**
     * Set the environment application
     */
    define ('DEVELOPMENT_ENVIRONMENT', true);
    /**
     * Constants variables to connect the database.
     */

    define('DB_HOST', 'localhost');
    define('DB_PORT', '8889');
    define('DB_USER', 'root');
    define('DB_NAME', 'asimpletrade');
    define('DB_PASSWORD', 'root');

    /**
     * Constants to multiples path.
     */
    define('DS', DIRECTORY_SEPARATOR);
    define('PATH_ROOT', dirname(__FILE__));
    define("APPLICATION_PATH", PATH_ROOT . DS .'application');
    define("PUBLIC_PATH", PATH_ROOT . DS .'web');
    define("UPLOAD_FILES", PATH_ROOT . DS .'data'. DS .'web');
    define('WS_PATH', 'http://localhost:8888/projetcs/REST_ANNONCE_V2/web');
    define('WEBSERVICE_UPLOAD', 'http://localhost:8888/projetcs/REST_ANNONCE_V2/upload/');
    define('DOCUMENT_TITLE', 'ASimpleTrade');
