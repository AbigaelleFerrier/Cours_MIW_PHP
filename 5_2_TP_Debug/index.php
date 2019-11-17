<?php

require 'config.php';
$bdd = getDB();
//liste des 5 derniers articles
$res = $bdd->query('SELECT a.* FROM article a LIMIT 5'); // limit 5
$articles = $res->fetchAll();


?>
<!-- table à l'extérieur de la boucle -->
    <table>
    <tr>
        <td>Image</td>
        <th>Titre</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
<?php foreach($articles as $article){ ?>
<?php $origDate = $article['datetime'];
 
 $newDate = date("d-m-Y H:i:s", strtotime($origDate)); //format date : H au lieu de h (format 24/12h)
 ?>
        <tr>
            <td><img src="assets/upload/thumb/<?php echo $article['image'] ?>_min_100x100.jpg"></td>
            <td><?php echo $article['titre'] ?></td>
            <td><?php echo $newDate ?></td><!-- supression du echo -->
            <td>
                <a href="article.php?id_article=<?php echo $article['id'] ?>">Lire</a>
            </td>
        </tr>
<?php } ?>
    </table>

<?php 
    $reqUser = $bdd->query('SELECT * FROM `user`');
    $users = $reqUser->fetchAll(PDO::FETCH_ASSOC);
?>

    <h3>AJOUT ARTICLE</h3>

    <form action="ajoutArticle.php" method="post" enctype="multipart/form-data">
        <input type="text" name="titre" value="Titre random" require>

        <input type="text" name="contenu" value="Contenu random -----------------" require>

        <select id="user" name="id_user" require>
            <?php foreach ($users as $user) { ?>
                <option value="<?php echo $user['id'] ?>"><?php echo $user['name'] ?></option>
            <?php } ?>
        </select></br>

        <input type="file" name="photo" id="photo" accept=".jpg, .jpeg, .png" size="2MB" require>
    
        <button type="submit">Upload</button>
    </form>