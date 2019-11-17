<?php
require 'config.php';
$bdd = getDB();

$req = $bdd->prepare('INSERT INTO commentaire (titre, contenu, id_user, id_article, datetime) 
        VALUES (:titre, :contenu, :id_user,:id_article,NOW())'); // bug trouver

$req->bindValue('titre'        , $_POST['titre']); //bug trouver    
$req->bindValue('contenu'      , $_POST['contenu']); //bug trouver
$req->bindValue('id_user'      , $_POST['id_user']); //bug trouver
$req->bindValue('id_article'   , $_POST['id_article']); //bug trouver
$req->execute();

header('Location: article.php?id_article='.(int)$_POST['id_article']);