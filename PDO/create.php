<?php 
    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=miw_world;charset=utf8;port=3307',
            'root',
            ''
        );

        var_dump($_POST);

        if (! ( isset($_POST['name']) && 
                isset($_POST['country_code']) &&
                isset($_POST['district']) &&
                isset($_POST['population']) &&

                strlen($_POST['country_code']) == 3
              )
            ) {
            throw new Exception("Valeur error", 1);       
        }

        $req = $bdd->prepare('INSERT INTO city (name, countrycode,district, population) VALUES(:name, :countrycode, :district, :population)');
        
        $name = $_POST['name'];
        $countryCode = $_POST['country_code'];
        $district = $_POST['district'];
        $population = $_POST['population'];

        $req->bindValue('name', $name, PDO::PARAM_STR);
        $req->bindValue('countrycode', $countryCode, PDO::PARAM_STR);
        $req->bindValue('district', $district, PDO::PARAM_STR);
        $req->bindValue('population', $population, PDO::PARAM_INT);
        
        if ($req->execute()) {
            header('Location:info?code='. $countryCode);
        }
        else {
            throw new Exception("Insert error", 1);   
        }

    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>