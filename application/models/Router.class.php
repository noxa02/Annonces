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
        $this->roadmap = $url->parserUrl();
        $roadmap = $this->roadmap;
        $this->folder = (!empty($roadmap)) ? array_shift($roadmap) : null;
        $folder = $this->folder;
        cleanArray($this, $folder);
        $action = (!empty($roadmap)) ? array_shift($roadmap) : null;
        
        $this->view_path = $this->existView($folder, $action);
        $this->controller_path = $this->existController($folder, $action);
    }

    function existView($folder, $action) 
    {
        return (is_readable(APPLICATION_PATH . '/views/'.ucfirst($folder).'/'.$action.'.view.php')) ?
            APPLICATION_PATH . '/views/'.ucfirst($folder).'/'.$action.'.view.php' : null;
    }
    
    function existController($folder, $action) 
    {
        return (is_readable(APPLICATION_PATH . '/controllers/'.ucfirst($folder).'/'.$action.'.controller.php')) ?
            APPLICATION_PATH . '/controllers/'.ucfirst($folder).'/'.$action.'.controller.php' : null;
    }
}