<?php
require 'config.php';//chemin d'accès
$bdd = getDB();

if (isset($_GET['id'])) //id au lieu de id_article
    $id = $_GET['id'];
else {
    header('Location: index.php');
    die();
}


$req = $bdd->prepare('SELECT * FROM `user` WHERE id=:id');
$req->bindValue(':id', $id, PDO::PARAM_INT);
$req->execute();
$user = $req->fetch(PDO::FETCH_ASSOC);

$reqCom = $bdd->prepare('SELECT * FROM commentaire WHERE id_user=:id_user');
$reqCom->bindValue(':id_user', $id, PDO::PARAM_INT);
$reqCom->execute();
$commentaires = $reqCom->fetchAll(PDO::FETCH_ASSOC);

?>

    <h1><?php echo $user['name'] ?></h1>
    <h3><?php echo $user['email'] ?></h3>


    <h3>Commentaire(s)</h3>
    <div>
        <?php
        if (count($commentaires)) {
            foreach ($commentaires as $commentaire) {
                ?>
                <div class="commentaire">
                    <?php echo nl2br($commentaire['contenu']) ?> <!-- nl2br pour afficher les retours à la ligne -->
                </div>
                <?php
            }
        } else {
            ?>
            <div>Aucun commentaire.</div>
        <?php } ?>
    </div>
