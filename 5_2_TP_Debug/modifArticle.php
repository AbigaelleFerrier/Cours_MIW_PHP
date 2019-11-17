<?php 
    if (isset($_GET['id_article'])) //id au lieu de id_article
        $id = $_GET['id_article'];
    else {
        header('Location: index.php');
        die();
    }

    require 'config.php';
    include 'ImageControler.php';

    $bdd = getDB();

    // var_dump($_POST);
    // var_dump($_FILES);
    // =============================================================== //

    try {
        // Verification de l'image avant l'envoie en BD
        if($_FILES['photo']['error'] == 0) {
            if (($e = ImageControler::controleUploadFile('photo')) != 'true') { throw new Exception($e);   }
        }

        $req = $bdd->prepare('UPDATE     article SET   titre   = :titre,   
                                                        contenu = :contenu,  
                                                        id_user = :id_user, 
                                                        image   = :nomImageTemporaire
                                                WHERE   id      = :id');

        //bindValue et non pas bindValues
        $req->bindValue('titre',    $_POST['titre']);
        $req->bindValue('contenu',  $_POST['contenu']);
        $req->bindValue('id_user',  $_POST['id_user']);
        $req->bindValue('nomImageTemporaire',  'article_'.$id);
        $req->bindValue('id',  $id);

        if ($req->execute()) {
            if($_FILES['photo']['error'] == 0) {
                if (($e = ImageControler::upload('photo', 'article_'.$id, true)) == 'true') { 

                    $req = $bdd->prepare('UPDATE article 
                                        SET `image` = :imageU 
                                        WHERE id=:id');

                    $req->bindValue('imageU', 'article_'.$id);
                    $req->bindValue('id'    , $id);
                    $req->execute();
                    header('Location:article.php?id_article='. $id); 
                }
            }
            else {
                header('Location:article.php?id_article='. $id); 
            }
        }
        else {
            header('Location:index.php?err=Erreur%20dans%20l%20enregistrement%20en%20base');
        }
    } catch (Exception $e) {
        header('Location:index.php?err=' . $e->getMessage());
    }


?>
