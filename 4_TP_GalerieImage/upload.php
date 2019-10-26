<?php
    include 'assets/php/controler/CONTROLER.php' ;

    try {
        $nom          = $_POST['nom'];
        $descP        = $_POST['desc'];
        $code_country = $_GET['code'];

        // Verification de l'image avant l'envoie en BD
        if (($e = ImageControler::controleUploadFile('photo')) != 'true') { throw new Exception($e);   }

        $req = $bdd->prepare('INSERT INTO gallery ( nom, descP,  code_country) 
                              VALUES              (:nom, :descP , :code_country)');
                
        $req->bindValue('nom'           , $nom          );
        $req->bindValue('descP'         , $descP        );
        $req->bindValue('code_country'  , $code_country );

        if ($req->execute()) {
            $id = $bdd->lastInsertId();
            if (($e = ImageControler::upload('photo', $id, true)) == 'true') { header('Location:info.php?code='. $code_country); }
            else                                                             { header('Location:info.php?code='. $code_country .'&err=' . $e->getMessage()); }
            // je n'est pas pu faire un ternaire ici :/ ...                 ↑↑↑
        }
        else {
            header('Location:info.php?code='. $code_country .'&err=Erreur%20dans%20l%20enregistrement%20en%20base');
        }
    } catch (Exception $e) {
        header('Location:info.php?code='. $code_country .'&err=' . $e->getMessage());
    }


    