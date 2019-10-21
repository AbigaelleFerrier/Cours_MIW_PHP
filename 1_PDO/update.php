<?php 
    var_dump($_POST);

    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=miw_world;charset=utf8;port=3307',
            'root',
            '',
            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING)
        );

        $req = $bdd->prepare('UPDATE    country 
                              SET       continent   = :continent,
                                        region      = :region,
                                        surfacearea = :surfacearea
                              WHERE     code        = :code                              
                            ');
        
        $continent      = $_POST['continent'];
        $region         = $_POST['region'];
        $surfacearea    = $_POST['surfacearea'];
        $code           = $_GET['code'];

        $req->bindValue('continent',    $continent);
        $req->bindValue('region',       $region);
        $req->bindValue('surfacearea',  $surfacearea, PDO::PARAM_INT);
        $req->bindValue('code',         $code);
        
        if ($req->execute()) {
            header('Location:info.php?code='. $code);
        }
        var_dump($req->execute());

    } catch (Exception $e) {
        echo $e->getMessage();
    }