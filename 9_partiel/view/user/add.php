<h1>Ajouter un User</h1>
<?php 
    if(isset($ajout)) 
        echo '<h3 style="color:red">'. $ajout. '</h3>';
?>
<form action="" method="post">
    <input type="text" name="name">
    <button type="submit">Ajouter</button>
</form>