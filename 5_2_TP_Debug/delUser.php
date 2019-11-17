<?php
require 'config.php';//chemin d'accès
$bdd = getDB();

if (isset($_GET['id'])) //id au lieu de id_article
    $id = $_GET['id'];
else {
    header('Location: index.php');
    die();
}


$req = $bdd->prepare('DELETE FROM `user` WHERE id=:id');
$req->bindValue(':id', $id, PDO::PARAM_INT);
$req->execute();
header('Location: admin.php');
