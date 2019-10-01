<?php 

try{
    $bdd = new PDO(
        'mysql:host=localhost;dbname=miw_world;charset=utf8;port=3307',
        'root',
        ''
    );

    // ----- EXO 1 ------

    // $req = $bdd->prepare('SELECT name FROM country WHERE population');
    // $population = 1000000;
    // $esperanceDeVie = 40;
    // $req->bindValue('population', $population, PDO::PARAM_INT);
    // $req->bindValue('esperance', $esperanceDeVie, PDO::PARAM_INT);
    // $req->bindValue('tri', $tri, PDO::PARAM_INT);

    // $req->execute(array('population'=>$population,
    // 'esperance'=>$esperanceDeVie));
    
    $req = $bdd->prepare('SELECT code,name,population FROM country ORDER BY population DESC');
    $req->execute();
    ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Population</th>
                </tr>
            </thead>

            <tbody>
                <?php
                    while ($row = $req->fetch()) {
                ?>
                        <tr>
                            <td><a href="info.php?code=<?php echo  $row['code']?>"><?php echo  $row['name']?></a></td>
                            <td><?php echo  $row['population']?></td>
                        </tr>        
                <?php 
                    }
                ?>
            </tbody>
        </table>
    <?php
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}
?>
