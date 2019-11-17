<?php
require 'config.php';//chemin d'accès
$bdd = getDB();

if (isset($_GET['id'])) //id au lieu de id_article
    $id = $_GET['id'];
else {
    header('Location: index.php');
    die();
}

// var_dump($_POST);

$req = $bdd->prepare('UPDATE user SET   name  = :name,   
                                        email = :email  
                                WHERE   id    = :id');

//bindValue et non pas bindValues
$req->bindValue('name',   $_POST['name']);
$req->bindValue('email',  $_POST['email']);
$req->bindValue('id',  $id);
$req->execute();

header('Location: admin.php');
