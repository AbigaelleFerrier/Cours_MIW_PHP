<h1>Livres</h1>
<table>

<?php foreach($livres as $livre){ ?>
    <tr>
        <td>Nom :</td>
        <td><?php echo $livre['nom'] ?></td>
        <td>
            <a href="<?php echo ROOT ?>livre/detail?id=<?php echo $livre['id']?>">Détail</a>
        </td>
        <td>
            <a href="<?php echo ROOT ?>livre/ajouterModifier?id=<?php echo $livre['id'] ?>">Modifier</a>
        </td>
        <td>
            <a href="<?php echo ROOT ?>livre/delete?id=<?php echo $livre['id'] ?>">Supprimer</a>
        </td>
    </tr>
<?php } ?>
</table><br>
<a href="<?php echo ROOT ?>livre/ajouterModifier">Ajouter un livre</a>

<h1>Auteurs</h1>
<table>
<?php foreach($auteurs as $auteur){ ?>
    <tr>
        <td>Nom :</td>
        <td><?php echo $auteur['nom'] .' '. $auteur['prenom'] ?></td>
        <td>
            <a href="<?php echo ROOT ?>auteur/detail?id=<?php echo $auteur['id']?>">Détail</a>
        </td>
        <td>
            <a href="<?php echo ROOT ?>auteur/ajouterModifier?id=<?php echo $auteur['id'] ?>">Modifier</a>
        </td>
        <td>
            <a href="<?php echo ROOT ?>auteur/delete?id=<?php echo $auteur['id'] ?>">Supprimer</a>
        </td>
    </tr>
<?php } ?>
</table><br>
<a href="<?php echo ROOT ?>auteur/ajouterModifier">Ajouter un auteur</a>
