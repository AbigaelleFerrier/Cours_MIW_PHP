<?php

class ImageControler {

    static private $pdfExt = ['pdf'];
    static private $imgExt = ['jpg', 'jpeg', 'gif', 'png'];
    static private $zipExt = ['zip', '7zip', 'tar.gz'];

    static private $Path      = 'assets/';
    static private $imgPath   = 'assets/img/';
    static private $pdfPath   = 'assets/pdf/';
    static private $thumbPath = 'assets/thumb/';

    static private $thumbName = 'thumb';

    static private $crops = [
            ['width' => 666, 'height' => 666]
        ];

    // Pas utilisable pour le moment pour le moment
    // $this->resize = [
    //     1080,
    //     600
    // ];

    private function __construct()
    {
        $pdfExt    = $this->pdfExt;     
        $imgExt    = $this->imgExt;    
        $zipExt    = $this->zipExt;     
        $Path      = $this->Path;       
        $imgPath   = $this->imgPath;    
        $pdfPath   = $this->pdfPath;    
        $thumbPath = $this->thumbPath;  
        $thumbName = $this->thumbName;  
        $crops     = $this->crops;  

        if(!is_dir($Path))    mkdir( $Path);
        if(!is_dir($imgPath)) mkdir( $imgPath);
        if(!is_dir($pdfPath)) mkdir( $pdfPath);
    }

    /**
     * 
     */
    public static function upload($__formInputName, $nameFinalFile = true, $croping = false) {
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
            
            if      (in_array($pathInfo['extension'], self::$pdfExt)){ $destDir =  self::$pdfPath; }
            else if (in_array($pathInfo['extension'], self::$imgExt)){ $destDir =  self::$imgPath; }
            else                                                     { throw new Exception('Fichier jpg, png, gif ou pdf uniquement', 1);   }

            
            $uniqueFileName = date('YmdHis') . '_' . microtime() . '.' .$pathInfo['extension'];

            if(!(move_uploaded_file($_FILES[$__formInputName]['tmp_name'], $destDir.$uniqueFileName))) throw new Exception('Erreur lors du stockage du fichier');
            
            return true;

        } catch (Exception $e) {
            return $e;
        }
    }


    public static function crop($filepath) {
        if(!file_exists($filepath))
            return false;

        //on récupère les données du document
            $pathInfo = pathinfo($filepath);
            $pathInfo['extension'] = strtolower($pathInfo['extension']);
            if(!in_array($pathInfo['extension'], self::$imgExt))
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

            
            $dossier = self::$imgPath;

        // L'image est tel en paysage (PAYSAGE ::  width > height) ou non (PORTRAIT ::  width < height)
            $paysage = ($imgsize[0] > $imgsize[1]);

        // Pour chaque element de self::$crops on redimentionne et on crop l'image
            foreach (self::$crops as $cropsParam) {

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

                //et on en fait un fichier jpeg avec une qualité de 90%
                    imagejpeg($thumbnail, $dossier. $pathInfo['filename'].'_'. self::$thumbName .'_'. $cropsParam['width'] . 'x' . $cropsParam['height'] .'.jpg', 90);
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
        if(!in_array($pathInfo['extension'], self::$imgExt))
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
        $dossier = self::$imgPath;
        imagejpeg($thumbnail, $dossier.$pathInfo['filename'].'_thumb_'.$thumbnailWitdh.'x'.$thumbnailHeight.'.jpg', 90);
        imagedestroy($source_gd_image);
        imagedestroy($thumbnail);
    }

}
