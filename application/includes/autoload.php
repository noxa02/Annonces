<?php 
      define('CURRENT_PATH', (string) (__DIR__ . '/'));
      // Ajout des chemins
      $path = (string) get_include_path();
      $path .= (string) (PATH_SEPARATOR . CURRENT_PATH . '../models/');
      $path .= (string) (PATH_SEPARATOR . CURRENT_PATH . '../models/Mapper');
      //$path .= (string) (PATH_SEPARATOR . CURRENT_PATH . '../../library/Zend/');
      //$path .= (string) (PATH_SEPARATOR . CURRENT_PATH . '../forms/');

      set_include_path($path);

      spl_autoload_register(function ($className) {
                  $className = (string) str_replace('\\', DIRECTORY_SEPARATOR, $className);
                  include_once(ucfirst($className) . '.class.php');
      });
