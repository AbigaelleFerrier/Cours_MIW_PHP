<h1>Ajouter un Ticket</h1>
<?php 
    if(isset($ajout)) 
        echo '<h3 style="color:red">'. $ajout. '</h3>';
?>
<form action="" method="post" enctype="multipart/form-data" >
    <select name="user" id="">
        <?php
            foreach($allUsers as $allUser) {
                echo '<option value="'.$allUser['id'].'">'. $allUser['name'] .'</option>';
            }
        ?>   
    </select>
    <input type="text" name="title" placeholder="Titre"><br>
    <textarea name="content" cols="30" rows="10"></textarea><br>
    <select name="priority">
            <option value="low">low</option>
            <option value="important">important</option>
            <option value="critical">critical</option>
    </select>
    <input type="file" name="fichier"><br>
    <button type="submit">Ajouter</button>
</form>