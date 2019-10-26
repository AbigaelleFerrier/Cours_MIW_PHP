<?php 
    include 'assets/php/controler/CONTROLER.php' ;
    echo HEAD::headerHTML('Accueil');
?>
    <body>
        <?php include 'assets/php/common/menu.php' ?>

        <div class="container">
            <div class="row">
                <div class="col">
                    <h1>ACCUEIL</h1>
                </div>
            </div>

            <?php
                $req = $bdd->prepare('SELECT code,name,population FROM country ORDER BY population DESC');
                $req->execute();

                $i = 0;

                while ($row = $req->fetch()) {
                    echo ($i%4 == 0)? '<div class="row">' : '';
            ?>
                        <div class="col">
                            <p>
                                <span class="H4like">
                                    <a href="info.php?code=<?php echo  $row['code']?>"><?php echo  $row['name']?></a>
                                </span>
                                <span>
                                    <?php echo  $row['population']?>
                                </span>
                            </p>     
                        </div>   
            <?php 
                    $i++;
                    echo ($i%4 == 0) ? '</div>' : '';
                }
                echo ($i%4 != 0) ? '</div>' : '';
            ?>
        </div>

        <?php include 'assets/php/common/footer.php' ?>

        
    </body>
</html>