<?php
require_once './core/Controller.php';

$data = explode('/', $_GET['p']);

$data[0] = empty($data[0])? 'Accueil': $data[0];
$data[1] = empty($data[1])? 'index'  : $data[1];
$data[2] = empty($data[2])? ''       : $data[2];

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
    $controller->$action($data[2]);
}else{
    die('method '.$action.' not found');
}
