<?php 
try {
    if (!($file = $_GET['route'])) throw new Exception("Fichier non passer en parametre", 1);

    $ext = explode('.', $file);
    $ext = strtolower($ext[count($ext)-1]);

    switch ($ext) {
        case 'GIF':
            $source_gd_image = imagecreatefromgif($file);
        break;
        
        case 'jpeg':
        case 'jpg':
            $source_gd_image = imagecreatefromjpeg($file);
        break;
        
        case 'PNG':
            $source_gd_image = imagecreatefrompng($file);
        break;
    }

    $imgsize = getimagesize($file);

    if($source_gd_image === false)  throw new Exception("erreur lors de la récupération de la source de l'image", 1);
    if($imgsize === false)          throw new Exception("erreur lors de la récupération de la source de l'image", 1);

    
    // Creation de l'img vide

    $thumbnailWitdh  = $imgsize[0] / 2;
    $thumbnailHeight = $imgsize[1] / 2;

    $thumbnail = imagecreatetruecolor($thumbnailWitdh, $thumbnailHeight);



} catch (Exception $e) {
    echo $e;
}
