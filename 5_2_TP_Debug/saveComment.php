<?php
require 'config.php';
$bdd = getDB();

$req = $bdd->prepare('INSERT INTO commentaire (titre, contenu, id_user, id_article, datetime) 
        VALUES (:titre, :contenu, :id_user,:id_article,NOW())');

//bindValue et non pas bindValues
$req->bindValue('titre', $_POST['titre']);
$req->bindValue('contenu', $_POST['contenu']);
$req->bindValue('id_user', $_POST['id_user']);
$req->bindValue('id_article', $_POST['id_article']);
$req->execute();

header('Location: article.php?id_article='.(int)$_POST['id_article']);