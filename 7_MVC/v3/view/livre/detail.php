<?php
/** @var Livre $livre */
?>
<a href="<?php echo ROOT ?>livre/liste">< Retour</a>
<h1><?php echo $livre->nom ?></h1>

<?php
    echo 'Auteur : ' . $auteur->nom . ' '.  $auteur->prenom .'<br>';
    echo 'Prix : '   . $livre->prix . '<br>';
