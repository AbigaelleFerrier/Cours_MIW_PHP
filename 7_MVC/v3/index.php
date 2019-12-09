<?php

include './view/common/head.php';

define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));

require_once './core/Controller.php';
require_once './core/Model.php';
require_once './model/Livre.php';
require_once './model/Auteur.php';

$data = explode('/', $_GET['p']);

$data[0] = empty($data[0])?'Livre':$data[0];
$data[1] = empty($data[1])?'liste':$data[1];

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
