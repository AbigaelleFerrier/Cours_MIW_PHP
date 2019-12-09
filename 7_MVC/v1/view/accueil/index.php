<?php
    foreach ($livres as  $livre) {
        ?>
            <p>Titre : <?php echo $livre['titre'] ?> | <a href="Livre/info/<?php echo $livre['idLivre']?>">LINK</a><br>
        <?php
    }
?>