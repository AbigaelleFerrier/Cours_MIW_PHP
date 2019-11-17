<?php

define('HOST', 'localhost');
define('DB_NAME', 'miw_php_tpdebug');
define('USER', 'root'); // bug trouver
define('PASS', '');

function getDB(){
    $bdd = false;
    try{
        $bdd = new PDO(
            'mysql:host='.HOST.';dbname='.DB_NAME.';charset=utf8;port=3307',
            USER, // bug trouver (inverser)
            PASS            
        );
    }catch(Exception $e){
        var_dump($e);
    }
    return $bdd;
}

function p($data=null){
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
}
function d($data= null){
    p($data);
    die();
}