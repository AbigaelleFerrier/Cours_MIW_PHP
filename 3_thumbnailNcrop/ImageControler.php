<?php

class ImageControler {

    public function __construct()
    {
        $this->pdfExt = ['pdf'];
        $this->imgExt = ['jpg', 'jpeg', 'gif', 'png'];
        // $this->zipExt = ['zip', '7zip', 'tar.gz'];

        $this->Path      = 'assets/';
        $this->imgPath   = $this->Path .'img/';
        $this->pdfPath   = $this->Path .'pdf/';
        $this->thumbPath = $this->Path .'thumb/';


        if(!is_dir($this->Path))    mkdir( $this->Path);
        if(!is_dir($this->imgPath)) mkdir( $this->imgPath);
        if(!is_dir($this->pdfPath)) mkdir( $this->pdfPath);



        $this->crops = [
            ['width' => 150, 'height' => 150],
            ['width' => 800, 'height' => 100],
            ['width' => 300, 'height' => 200],
            ['width' => 800, 'height' => 300],
            ['width' => 800, 'height' => 400],
            ['width' => 800, 'height' => 500],
            ['width' => 800, 'height' => 600]
        ];


        $this->resize = [
            1080,
            600
        ];


    }
    
    /**
     * 
     */
    function upload($__formInputName) {
        try {
            if (! isset($_FILES[$__formInputName])) throw new Exception("Photo non envoyer", 1);
            
            if (!($_FILES[$__formInputName]['error'] == UPLOAD_ERR_OK)) {
                switch ($_FILES[$__formInputName]['error']){
                    case UPLOAD_ERR_INI_SIZE:
                        throw new Exception ('Le fichier reçu dépasse la limite de '.ini_get('upload_max_filesize').'.');
                        break;
                    case UPLOAD_ERR_PARTIAL:
                    case UPLOAD_ERR_NO_TMP_DIR:
                    case UPLOAD_ERR_CANT_WRITE:
                    case UPLOAD_ERR_EXTENSION:
                        throw new Exception ('Erreur lors de l\'uplaod, veuillez réessayer.');
                        break;
                    case UPLOAD_ERR_NO_FILE:
                        throw new Exception ('Erreur lors de l\'uplaod, aucun fichier reçu.');
                        break;
                }
            }
        
            $pathInfo              = pathinfo($_FILES[$__formInputName]['name']);
            $pathInfo['extension'] = strtolower($pathInfo['extension']);
            
            if      (in_array($pathInfo['extension'], $this->pdfExt)){ $destDir =  $this->pdfPath; }
            else if (in_array($pathInfo['extension'], $this->imgExt)){ $destDir =  $this->imgPath; }
            else                                                     { throw new Exception('Fichier jpg, png, gif ou pdf uniquement', 1);   }

            
            $uniqueFileName = date('YmdHis') . '_' . microtime() . '.' .$pathInfo['extension'];

            if(!(move_uploaded_file($_FILES[$__formInputName]['tmp_name'], $destDir.$uniqueFileName))) throw new Exception('Erreur lors du stockage du fichier');
            
            return true;

        } catch (Exception $e) {
            return $e;
        }
    }


    function crop($filepath) {
        if(!file_exists($filepath))
            return false;

        //on récupère les données du document
            $pathInfo = pathinfo($filepath);
            $pathInfo['extension'] = strtolower($pathInfo['extension']);
            if(!in_array($pathInfo['extension'], $this->imgExt))
                return false;


        //récupération de la source de l'image d'origine
            switch ($pathInfo['extension']) {
                case 'GIF':
                    $source_gd_image = imagecreatefromgif($filepath);
                    break;
                case 'jpeg':
                case 'jpg':
                    $source_gd_image = imagecreatefromjpeg($filepath);
                    break;
                case 'PNG':
                    $source_gd_image = imagecreatefrompng($filepath);
                    break;
            }

            $imgsize = getimagesize($filepath);

            if($source_gd_image === false)  return false;        
            if($imgsize         === false)  return false;

            
            $dossier = $this->imgPath;

        // L'image est tel en paysage (PAYSAGE ::  width > height) ou non (PORTRAIT ::  width < height)
            $paysage = ($imgsize[0] > $imgsize[1]);

        // Pour chaque element de $this->crops on redimentionne et on crop l'image
            foreach ($this->crops as $cropsParam) {

                //on créé une image "vide" (une image noire)
                    $thumbnail = imagecreatetruecolor($cropsParam['width'], $cropsParam['height']);

                //On calcule le produit en croix selon si l'image est en mode portrait ou paysage     
                // cependant si la valeur ainsi calculer est < a la valeur de notre cadre 
                // on effectue le calcul opposer 
                      
                    if ($paysage) {
                        $width_imgSrc  = floor(($imgsize[0] * $cropsParam['height']) / $imgsize[1]);
                        $height_imgSrc = $cropsParam['height'];

                        if($width_imgSrc < $cropsParam['width']) { // si trop petit
                            $width_imgSrc  = $cropsParam['width'];
                            $height_imgSrc = floor(($imgsize[1] * $cropsParam['width']) / $imgsize[0]);
                        }    
                    }
                    else {
                        $width_imgSrc  = $cropsParam['width'];
                        $height_imgSrc = floor(($imgsize[1] * $cropsParam['width']) / $imgsize[0]);

                        if($height_imgSrc < $cropsParam['height']) { // si trop petit
                            $width_imgSrc  = floor(($imgsize[0] * $cropsParam['height']) / $imgsize[1]);
                            $height_imgSrc = $cropsParam['height'];
                        }
                    }

                    $x_imgSrc = floor(($width_imgSrc  - $cropsParam['width'] ) / 2);
                    $y_imgSrc = floor(($height_imgSrc - $cropsParam['height']) / 2);
                        
                    
                //on créé une copie de notre image source
                    imagecopyresampled(
                        $thumbnail, 
                        $source_gd_image,
                        0, 0, $x_imgSrc, $y_imgSrc, 
                        $width_imgSrc,
                        $height_imgSrc,
                        $imgsize[0], 
                        $imgsize[1]);

                        var_dump('cropsParam : '  . $cropsParam['width']);                        
                        var_dump('cropsParam : '  . $cropsParam['height']);
                        var_dump('width_imgSrc : '  . $width_imgSrc);
                        var_dump('height_imgSrc : ' . $height_imgSrc);
                        var_dump('x_imgSrc : ' . $x_imgSrc);
                        var_dump('y_imgSrc : ' . $y_imgSrc);
                        echo '<br>';

                //et on en fait un fichier jpeg avec une qualité de 90%
                    imagejpeg($thumbnail, $dossier. $pathInfo['filename'].'_thumb_'. $cropsParam['width'] . 'x' . $cropsParam['height'] .'.jpg', 90);
                    imagedestroy($thumbnail);
            }
        imagedestroy($source_gd_image);
    }





    /**
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     * 
     */

    function resize($filepath, $thumbnailWitdh=null, $thumbnailHeight = null) {
        if(!file_exists($filepath))
            return false;


        //on récupère les données du document
        $pathInfo = pathinfo($filepath);
        $pathInfo['extension'] = strtolower($pathInfo['extension']);
        if(!in_array($pathInfo['extension'], $this->imgExt))
            return false;


        //récupération de la source de l'image d'origine
        switch ($pathInfo['extension']) {
            case 'GIF':
                $source_gd_image = imagecreatefromgif($filepath);
                break;
            case 'jpeg':
            case 'jpg':
                $source_gd_image = imagecreatefromjpeg($filepath);
                break;
            case 'PNG':
                $source_gd_image = imagecreatefrompng($filepath);
                break;
        }

        $imgsize = getimagesize($filepath);

        if($source_gd_image === false)  return false;        
        if($imgsize         === false)  return false;

        if(is_null($thumbnailWitdh) && is_null($thumbnailHeight))  return false;


        if(is_null($thumbnailWitdh)){
            $thumbnailWitdh = floor($thumbnailHeight*$imgsize[0]/$imgsize[1]);
        }else{
            $thumbnailHeight = floor($thumbnailWitdh*$imgsize[1]/$imgsize[0]);
        }

        //on créé une image "vide" (une image noire)
        $thumbnail = imagecreatetruecolor($thumbnailWitdh, $thumbnailHeight);

        //on créé une copie de notre image source
        imagecopyresampled($thumbnail, $source_gd_image, 0, 0, 0, 0, $thumbnailWitdh, $thumbnailHeight, $imgsize[0], $imgsize[1]);
        //et on en fait un fichier jpeg avec une qualité de 90%
        $dossier = $this->imgPath;
        imagejpeg($thumbnail, $dossier.$pathInfo['filename'].'_thumb_'.$thumbnailWitdh.'x'.$thumbnailHeight.'.jpg', 90);
        imagedestroy($source_gd_image);
        imagedestroy($thumbnail);
    }

}

