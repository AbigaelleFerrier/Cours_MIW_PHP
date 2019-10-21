<?php
    try {
        if (! is_dir('./img')) mkdir("img");

        if (! isset($_FILES['photo']))                                  throw new Exception("Photo non envoyer", 1);
        if         ($_FILES['photo']['error'] == UPLOAD_ERR_INI_SIZE)   throw new Exception("Taille du fichier trop grande", 1);
        if (!      ($_FILES['photo']['error'] == UPLOAD_ERR_OK))        throw new Exception("Erreur lors de l'envoye", 1);

    
        $ext  = strtolower(substr(strrchr($_FILES['photo']['name'], '.'),1));


        if ($ext == 'png'  || $ext == 'jpg' || $ext == 'jpeg') { // PNG & JPG 
            if (! is_dir('./jpg_png'))  mkdir("img/jpg_png");
            $dossier = "img/jpg_png/";
        }
        else if ($ext == 'pdf') { // PDF
            if (! is_dir('./img'))      mkdir("img/pdf");    
            $dossier = "img/pdf/";
        }
        else if ($ext == 'gif') { // GIF
            if (! is_dir('./img'))      mkdir("img/gif");
            $dossier = "img/gif/";
        }
        else {
            throw new Exception('L\'extention n\'est pas : "jpg", "png", "gif", "pdf"', 1);
        }

        $nom =  $dossier . microtime() .'.'. $ext;
        $resultat = move_uploaded_file($_FILES['photo']['tmp_name'],  $nom);
    
        if (!$resultat) throw new Exception("Erreur lors de la sauvegarde du fichier", 1);

        header('Location:index.php?code=OK');

    } catch (Exception $e) {
        header('Location:index.php?code='. $e->getMessage());
    }