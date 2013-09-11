<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class BaseController{
    private $_registry;
    public $view;
    private $_db;
    public $upload;
    public $model;
            
    public function __construct($registry) {
        $this->_registry = $registry;
        $this->view = $registry->view;
        $this->_db = $registry->db;
        $this->upload = $registry->upload;
    }
    
    public function load_model($name){
        $path = 'app/model/'.$model.'.php';
        if(file_exists($path)){
            if(is_readable($path)){
                $this->model = new ucfirst($name);
            }
        }
    }
    
    public function __destruct(){
        ;
    }
    
}
?>
