<?php
    define('BASE_URL', Url::getBaseUrl());
    
    $router = new Router();
    $router->constructRoute();

    $controller = $router->controller_path;
    $view       = $router->view_path;

    if(is_null($view) && is_null($controller)) {
        $view = $router->existView('Default', 'default');
    } elseif($controller == '404') {
        $view = $router->existView('Common', '404');
    }

    if(!is_null($controller)) {
        require_once $controller; 
    } elseif(is_null($controller)) {
        require_once $router->existController('Default', 'default');
    } elseif(is_null($view) && is_null($controller)) {
        $controller = '404'; 
    }