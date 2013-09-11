<?php

class Bootstrap {

    private $registry;
    private $controller;
    private $method;
    private $param;
    private $file;
    private $url = array();

    public function __construct($registry) {
        $this->registry = $registry;
    }
    
    /*
     * mendapatkan url dan pembuatan objek controller 
     */
    public function getController() {
        $page = ($_GET['page']) ? $_GET['page'] : 'index';
        $page = rtrim($page, '/');
        $this->url = explode('/', $page);

        if (isset($this->url[0])) {
            $this->file = ROOT . '/app/controllers/' . ucfirst($this->url[0]) . 'Controller.php';
            if (is_readable($this->file)) {
                $name = ucfirst($this->url[0]).'Controller';
                $this->controller = new $name($this->registry);
            } else {
                $this->controller = new Index($this->registry);
            }
        }
    }
    
    /*
     * cek method di controller
     */
    private function getAction() {
        if (isset($this->url[1])) {
            if (method_exists($this->controller, $this->url[1])) {
                $this->method = $this->url[1];
            } else {
                $this->method = 'index';
            }
        } else {
            $this->method = 'index';
        }
    }
    
    /*
     * loader url
     */
    public function loader() {
        
        /*         * * check the route ** */
        $this->getController();
        
        $this->getAction();
        
        /*         * * check if the action is callable ** */
        if (is_callable(array($this->controller, $this->method)) == false) {
            $action = 'index';
        } else {
            $action = $this->method;
        }

        /*         * * load arguments for action ** */
        $arguments = array();
        $i = 0;
        foreach ($this->url as $key => $val) {
            if ($key > 1) {
                $arguments[$this->url[$key - 1]] = $val;
                $i++;
            }
        }

        if ($i > 1)
            call_user_func(array($this->controller, $action), $arguments);
        else
            call_user_func_array(array($this->controller, $action), $arguments);
    }

    public function __destruct() {
        ;
    }

}

?>