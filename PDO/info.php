<?php
    // --------- Exo 2 Partie 1 ---------

    try {
        $bdd = new PDO(
            'mysql:host=localhost;dbname=miw_world;charset=utf8;port=3307',
            'root',
            ''
        );

        if (! (isset($_GET['code']) && strlen($_GET['code']) == 3)) {
            throw new Exception("Code de la ville non valide (!=3) ou non present dans le Get", 1);       
        }


        $req = $bdd->prepare('SELECT * FROM country WHERE code = :code');
        $req->bindValue('code', $_GET['code'], PDO::PARAM_STR);
        $req->execute();

       

        if ($country = $req->fetch()) {

            $req2 = $bdd->prepare('SELECT name FROM city WHERE id = :id');
            $req2->bindValue('id', $country['capital'], PDO::PARAM_INT);
            $req2->execute();

            if (! ($capital = $req2->fetch())) {
                throw new Exception("Erreur sur id de la capital", 1);       
            }
               
            

?>
            <h1><?php echo $country['name'] ?></h1>
            <h2><?php echo $capital['name'] ?></h2>
            <h4><?php echo $country['code'] ?><h4>
            <ul>
                <li>continent : <?php echo $country['continent'] ?></li>
                <li>region : <?php echo $country['region'] ?></li>
                <li>surface area :<?php echo $country['surfacearea'] ?> km2</li>
            </ul>
            <hr>
            <ul>
                <li>indepyear : <?php echo $country['indepyear'] ?></li>
                <li>population : <?php echo $country['population'] ?></li>
                <li>lifeexpectancy : <?php echo $country['lifeexpectancy'] ?></li>
            </ul>
            <hr>
            <ul>
                <li>gnp : <?php echo $country['gnp'] ?></li>
                <li>gnpold : <?php echo $country['gnpold'] ?></li>
            </ul>
            <hr>
            <ul>
                <li>LocalName : <?php echo $country['LocalName'] ?></li>
                <li>governmentform : <?php echo $country['governmentform'] ?></li>
                <li>headofstate : <?php echo $country['headofstate'] ?></li>
                <li>code2 : <?php echo $country['code2'] ?></li>
            </ul>
            
            <hr>
<?php
            // --------- Exo 2 Partie 2 ---------

            $req = $bdd->prepare('SELECT name FROM city WHERE countrycode = :code ORDER BY name');
            $req->bindValue('code', $_GET['code'], PDO::PARAM_STR);
            $req->execute();

            $i=0;
            while (($city = $req->fetch()) && ($i < 4) ) {
                echo '<p>'. $city['name'] . '</p>';
                $i++;
            }


        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
?>
<hr>

<form action="create.php" method="post" id="yousk2">
    <label for="name">Name</label>
    <input placeholder="Name city" name="name" type="text" require><br>
    
    <label for="country_code">Country Code</label>
    <input placeholder="Country Code" name="country_code" type="text" value="<?php echo $country['code'] ?>"><br>
    
    <label for="district">District</label>
    <input placeholder="District city" name="district" type="text" require><br> 

    <label for="population">Population</label>
    <input placeholder="Population city" name="population" type="number" require><br> 
    <input type="submit" value="Envoyer le formulaire">
</form>