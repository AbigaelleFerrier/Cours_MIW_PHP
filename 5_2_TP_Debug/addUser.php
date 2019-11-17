<?php
require 'config.php';//chemin d'accès
$bdd = getDB();


$req = $bdd->prepare('INSERT INTO user (name, email) VALUES (:name, :email)');
$req->bindValue('name',   $_POST['name']);
$req->bindValue('email',  $_POST['email']);
$req->execute();
header('Location: admin.php');
