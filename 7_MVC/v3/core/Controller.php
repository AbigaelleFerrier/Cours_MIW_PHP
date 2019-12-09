<?php

class Controller{
    public $vars = [];

    public function set($vars){
        $this->vars = array_merge($this->vars, $vars);
    }

    public function render($view){
        $currentController = get_class($this);//AccueilController
        $currentController = str_replace('Controller','', $currentController); //Accueil
        $currentController = strtolower($currentController); //accueil

        extract($this->vars);
        // ./view/accueil/index.php
        include './view/'.$currentController.'/'.$view.'.php';

    }
}