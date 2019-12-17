<!-- On affiche tous les user -->
<h1>UTILISATEUR</h1>
<ul>
<?php 
    foreach($users as $user) {
        echo '<li><a href="'.ROOT.'user/profil?id='.$user['id'].'">'. $user['name'] .'</li></a>';
    }
?>
</ul>

<a href="<?php echo ROOT?>/user/add">Ajouter un user</a>