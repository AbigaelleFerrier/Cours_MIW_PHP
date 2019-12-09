<?php
if (is_null($livre->id)) {
    $action = 'Ajouter';
} else {
    $action = 'Modifier';
}

$select = '<select id="auteur" name="id_auteur" type="text" required>';
foreach (Auteur::getAll() as $row) {
    $s = ($auteur->id == $row[0] )? 'selected' : '';
    $select .= '<option '. $s .' value="'. $row['id'] .'">'. $row['nom'] . ' '. $row['prenom'] .'</option>';
}
$select .= '</select><br>';

echo '<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Portfolio de Sylvian Brunet">
        <title>Formulaire d\'ajout de livre</title>
    </head>
    <body>
        <form method="post" action="' . ROOT . 'livre/post">

            <input id="id" name="id" type="text" hidden     value="' . $livre->id . '">
            
            <label for="nom">Nom : </label>
            <input id="nom" name="nom" type="text"          value="' . $livre->nom . '" required><br>
            
            <label for="isbn">Isbn : </label>
            <input id="isbn" name="isbn" type="text"        value="' .$livre->isbn . '" required><br>
            
            <label for="resume">Résumé : </label>
            <input id="resume" name="resume" type="text"    value="' .$livre->resume . '" required><br>
            
            <label for="auteur">Auteur : </label>
            '. $select .'
            
            <label for="prix">Prix : </label>
            <input id="prix" name="prix" type="text"        value="' .$livre->prix . '" required><br>
            
            <button type="submit">' . $action . '</button>
        </form>
    </body>
</html>';