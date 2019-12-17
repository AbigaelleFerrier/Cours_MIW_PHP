<?php

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
// => /php/1/mvc/

spl_autoload_register(function ($class){
    if(preg_match("/Controller$/", $class)){
        //on charge un controller
        $controllerFilename = './controller/'.$class.'.php';
        if(file_exists($controllerFilename)){
            require_once $controllerFilename;
        }else{
            die('Controller not found');
        }
    }else{
        //include model
        $modelFilename = './model/'.$class.'.php';
        if(file_exists($modelFilename)){
            require_once $modelFilename;
        }else{
            die('Model not found');
        }
    }
});

require_once './core/Controller.php';
require_once './core/Model.php';
require_once './manager/ImageManager.php';

$data = explode('/', $_GET['p']);

$data[0] = empty($data[0])?'Accueil':$data[0];
$data[1] = empty($data[1])?'index':$data[1];

$controller = ucfirst($data[0]).'Controller';

$controllerFilename = './controller/'.$controller.'.php';
if(file_exists($controllerFilename)){
    require_once $controllerFilename;
}else{
    die('Controller not found');
}

$controller = new $controller();
$action = $data[1];
if(method_exists($controller, $action)){
    $controller->$action();
}else{
    die('method '.$action.' not found');
}
