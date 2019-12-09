<?php
if (is_null($auteur->id)) {
    $action = 'Ajouter';
} else {
    $action = 'Modifier';
}

echo '<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Portfolio de Sylvian Brunet">
        <title>Formulaire d\'ajout de livre</title>
    </head>
    <body>
        <form method="post" action="' . ROOT . 'auteur/post">

            <input id="id" name="id" type="text" hidden     value="' . $auteur->id . '">
            
            <label for="nom">Nom : </label>
            <input id="nom" name="nom" type="text"          value="' . $auteur->nom . '" required><br>
            
            <label for="isbn">prenom : </label>
            <input id="isbn" name="prenom" type="text"        value="' .$auteur->prenom . '" required><br>
            
            <label for="resume">date_naissance : </label>
            <input id="resume" name="date_naissance" pattern="^[0-9]{4}-[0-9]{2}-[0-9]{2}$" type="text"    value="' .$auteur->date_naissance . '" required><br>
            
            
            <button type="submit">' . $action . '</button>
        </form>
    </body>
</html>';