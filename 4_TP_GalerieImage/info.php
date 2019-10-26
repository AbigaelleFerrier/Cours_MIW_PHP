<?php 
    include 'assets/php/controler/CONTROLER.php' ;
    echo HEAD::headerHTML('Accueil');
?>
    <body>
        <?php include 'assets/php/common/menu.php' ?>

        <div class="container">
            <?php
                try {

                    if (! (isset($_GET['code']) && strlen($_GET['code']) == 3)) {
                        throw new Exception("Code de la ville non valide (!=3) ou non present dans le Get", 1);       
                    }


                    $req = $bdd->prepare('SELECT * FROM country WHERE code = :code');
                    $req->bindValue('code', $_GET['code'], PDO::PARAM_STR);
                    if(!$req->execute()){
                        throw new Exception("Le code de la ville n'existe pas", 1);
                    }

                
                    if ($country = $req->fetch()) {

                        $req2 = $bdd->prepare('SELECT name FROM city WHERE id = :id');
                        $req2->bindValue('id', $country['capital'], PDO::PARAM_INT);
                        $req2->execute();

                        if (($capital = $req2->fetch())) {
                        }
                        else {
                            $capital ['name'] = "Aucune capital";
                        }
                            
            ?>
                        
                        <div class="row">
                            <div class="col">
                                <h1><?php echo $country['name'] ?></h1>
                                <h2><?php echo $capital['name'] ?></h2>
                                <h4><?php echo $country['code'] ?></h4>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col">
                                <form action="update.php?code=<?php echo $_GET['code'] ?>" method="post">
                                    <ul>
                                        <li>continent :     <input type="text" name="continent"   value="<?php echo $country['continent'] ?>"> </li>
                                        <li>region :        <input type="text" name="region"      value="<?php echo $country['region'] ?>"> </li>
                                        <li>surface area :  <input type="text" name="surfacearea" value="<?php echo $country['surfacearea'] ?>"> km2</li>
                                        <button type="submit">Enregistre</button>
                                        <a href="del.php?code=<?php echo $_GET['code'] ?>">SUPPRIMER</a>
                                    </ul>
                                </form>
                            </div>
                            <div class="col">
                                <ul>
                                    <li>indepyear : <?php echo $country['indepyear'] ?></li>
                                    <li>population : <?php echo $country['population'] ?></li>
                                    <li>lifeexpectancy : <?php echo $country['lifeexpectancy'] ?></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col">
                                <ul>
                                    <li>gnp : <?php echo $country['gnp'] ?></li>
                                    <li>gnpold : <?php echo $country['gnpold'] ?></li>
                                </ul>
                            </div>
                            <div class="col">
                                <ul>
                                    <li>LocalName : <?php echo $country['LocalName'] ?></li>
                                    <li>governmentform : <?php echo $country['governmentform'] ?></li>
                                    <li>headofstate : <?php echo $country['headofstate'] ?></li>
                                    <li>code2 : <?php echo $country['code2'] ?></li>
                                </ul>
                            </div>
                            <div class="col">
                                <h3>City</h3>
                                <ul>
                                <?php 
                                    $req = $bdd->prepare('SELECT name FROM city WHERE countrycode = :code ORDER BY name');
                                    $req->bindValue('code', $_GET['code'], PDO::PARAM_STR);
                                    $req->execute();

                                    $i=0;
                                    while (($city = $req->fetch()) && ($i < 4) ) {
                                        echo '<li>'. $city['name'] . '</li>';
                                        $i++;
                                    }
                                ?>
                                </ul>
                            </div>
                        </div>
                        <div class="row">                            
                            <div class="col">
                                <h3>Ajouter une ville</h3>
                                <form action="create.php" method="post" id="yousk2">
                                    <label for="name">Name</label>
                                    <input placeholder="Name city" name="name" type="text" require><br>
                                    
                                    <label for="country_code">Country Code</label>
                                    <input placeholder="Country Code" name="country_code" type="text" value="<?php echo $country['code'] ?>"><br>
                                    
                                    <label for="district">District</label>
                                    <input placeholder="District city" name="district" type="text" require><br> 

                                    <label for="population">Population</label>
                                    <input placeholder="Population city" name="population" type="number" require><br> 
                                    <input type="submit" value="Ajouter la ville">
                                </form>
                            </div>
                            <div class="col">
                                <h3>Ajouter une photo a la galerie</h3>
                                <?php 
                                    if(isset($_GET['err'])) {
                                        echo '<p style="color:#ff0000">'. $_GET['err'] .'</p>';
                                    }
                                ?>
                                <form action="upload.php?code=<?php echo $country['code']  ?>" method="post" enctype="multipart/form-data">

                                    <label for="nom">nom</label>
                                    <input placeholder="nom"  name="nom"  value="NOM DE TEST"   type="text" require><br>
                                    <label for="desc">desc</label>
                                    <input placeholder="desc" name="desc" value="DESC DE TEST"  type="text" require><br>
                                    
                                    <input type="file" name="photo" id="photo" accept=".jpg, .jpeg, .png" size="2MB" require>
                                    <button type="submit">Envoyer la photo</button>
                                </form>
                            </div>
                        </div> 
                        
                        



                <?php
                    } 
                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            ?>
        </div>

        <div class="container gallery">
            <?php
                try {
                    $reqGalerie = $bdd->prepare('SELECT * FROM gallery WHERE code_country = :code_country');

                    $reqGalerie->bindValue('code_country', $_GET['code'], PDO::PARAM_STR);
                    if(!$reqGalerie->execute()){
                        throw new Exception("Le code de la ville n'existe pas", 1);
                    }

                    $i = 0;

                    while ($galerie = $reqGalerie->fetch()) {
                        echo ($i%4 == 0)? '<div class="row">' : '';
                    ?> 
                            <input type="checkbox"  id="gallery_<?php echo $i;?>">
                            <label class="col"      for="gallery_<?php echo $i;?>">
                                <img src="assets/upload/thumb/<?php echo $galerie['id']; ?>_min_150x150" alt="<?php echo $galerie['descP']; ?>">
                                <div class="openZone">
                                    <h4 class="title"><?php echo $galerie['nom'];?></h4>
                                    <p>
                                        <a target="_blank" href="assets/upload/src/<?php echo $galerie['id']; ?>">Image source</a>
                                        <br><?php echo $galerie['descP']; ?>
                                    </p>
                                </div>
                            </label>
                    <?php  
                        $i++;
                        echo ($i%4 == 0) ? '</div>' : '';
                    }
                    echo ($i%4 != 0) ? '</div>' : '';

                } catch (Exception $e) {
                    echo $e->getMessage();
                }
            ?>
        </div>

        


        <?php include 'assets/php/common/footer.php' ?>

        
    </body>
</html>