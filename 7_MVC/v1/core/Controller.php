<?php

class Controller{
    public $vars = [];

    public function set($vars){
        $this->vars = array_merge($this->vars, $vars);
    }

    public function render($view){
        extract($this->vars);
        $controllerFilename = './view/'. strtolower(str_replace('Controller', '',get_class($this))) . '/' . $view . '.php';
        if(file_exists($controllerFilename)){
            include $controllerFilename;
        }
        else{
            die('View not found');
        }
    }
}