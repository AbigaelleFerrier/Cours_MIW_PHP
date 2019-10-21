<?php 
   
    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=miw_world;charset=utf8;port=3307',
            'root',
            '',
            array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING)
        );

        $req = $bdd->prepare('DELETE FROM countrylanguage WHERE countrycode = :code');
        $code = $_GET['code'];
        $req->bindValue('code',$code, PDO::PARAM_STR);
        
        if ($req->execute()) {

            $req = $bdd->prepare('DELETE FROM city WHERE countrycode = :code');
            $code = $_GET['code'];
            $req->bindValue('code',$code, PDO::PARAM_STR);

            if ($req->execute()) {

                $req = $bdd->prepare('DELETE FROM country WHERE code = :code');
                $code = $_GET['code'];
                $req->bindValue('code',$code, PDO::PARAM_STR);
                
                if ($req->execute()) {
                    header('Location:pdo.php');
                }
            }
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }