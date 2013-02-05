<?php
class Router {
    
    private $data = array();

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
    }
    
    public
    function constructRoute() 
    {
        $url = new Url();
        $args = refreshArrayKeys($url->parserUrl());
        if(empty($args)) {
            $this->controller = 'default'; 
            $this->action = 'index'; 
        } else {
            foreach ($args as $key => $value) {
                switch ($key) {
                    case 0 : 
                        if(is_string($value) && !is_integer($value)) {
                            $this->controller = $value;  
                        }
                    break;
                    case 1 : 
                        if(is_string($value) && !is_integer($value)) {
                            $this->action = $value;  
                        }
                    break;
                    case 2 : 
                        if(preg_match('/^([0-9]+)$/', $value, $matches)) {
                            $this->id = $value;  
                        }
                    break;
                }
            }
        }
        
        if(!$this->existAction($this->controller, $this->action)
                && !$this->existController($this->controller, $this->action)) {
            return false;
        } else return true;
    }

    function existAction($folder, $action) 
    {
        if(is_readable(APPLICATION_PATH . '/controllers/'.ucfirst($folder).'/'.strtolower($action).'.controller.php') 
                && is_readable(APPLICATION_PATH . '/views/'.ucfirst($folder).'/'.strtolower($action).'.view.php')) {
            return true;
        }
            return false;
    }
    
    function existController($folder, $action) 
    {
        if(is_readable(APPLICATION_PATH . '/controllers/'.ucfirst($folder).'/'.strtolower($action).'.controller.php')) {
            return true;
        }
            return false;
    }
    
    public
    function getControllerPath() {
        if($this->controller && $this->action)
        return APPLICATION_PATH . '/controllers/'.ucfirst($this->controller).'/'.strtolower($this->action).'.controller.php';
    }
    
    public
    function getViewPath() {
        if($this->controller && $this->action)
        return APPLICATION_PATH . '/views/'.ucfirst($this->controller).'/'.strtolower($this->action).'.view.php';
    }
}