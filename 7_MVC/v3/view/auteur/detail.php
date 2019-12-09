<?php
/** @var Auteur $auteur */
?>
<a href="<?php echo ROOT ?>livre/liste">< Retour</a>
<h1><?php echo $auteur->nom .' '; echo $auteur->prenom ;?></h1>


<?php
    echo 'Auteur : ' . $auteur->nom . ' '.  $auteur->prenom .'<br>';
    echo 'DDN : '    . $auteur->date_naissance . '<br>';
?>
<h5>Livres : </h5>
    <table>
<?php
    foreach($auteur->getLivre() as $livre){ ?>
        <tr>
            <td>Nom :</td>
            <td><?php echo $livre['nom'] ?></td>
            <td><a href="<?php echo ROOT ?>livre/detail?id=<?php echo $livre['id']?>">Détail</a></td>
            <td><a href="<?php echo ROOT ?>livre/ajouterModifier?id=<?php echo $livre['id'] ?>">Modifier</a></td>
        </tr>
<?php } ?>
</table><br>
