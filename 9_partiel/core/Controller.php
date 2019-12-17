<?php

class Controller{
    public $vars = [];
    public $layout = 'layout';

    public function set($vars){
        $this->vars = array_merge($this->vars, $vars);
    }

    public function render($view){
        $currentController = get_class($this);//AccueilController
        $currentController = str_replace('Controller','', $currentController); //Accueil
        $currentController = strtolower($currentController); //accueil

        //include
        extract($this->vars);

        ob_start();
        // ./view/accueil/index.php
        include './view/'.$currentController.'/'.$view.'.php';
        $content = ob_get_clean();

        if($this->layout)
            include './view/'.$this->layout.'.php';
        else
            echo $content;
    }

    public static function fetch($controller, $action){
        $controller .= 'Controller';
        $controller = new $controller();
        $controller->$action();
    }
}