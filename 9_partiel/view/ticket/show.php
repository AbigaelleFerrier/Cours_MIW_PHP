<?php
    echo '<h1>'. $ticket->title .'</h1>'; 
    echo '<h2>By '. $user->name .' | <span style="color:red">'. $ticket->priority .'</h2>';
    echo '<p>'. $ticket->content .'</p>';
    
    if ($ticket->attached_file != '') {
        echo '<a href="'. ROOT . $ticket->attached_file .'">FICHIER</a>';
    }


    echo '<hr>';

    foreach ($resps as $resp) {
        echo '<p>
                => '. User::get($resp['id_user'])['name'] . '<br>';
            echo $resp['content'];
    }
?>
    <hr>

    <form action="<?php echo ROOT ?>ticket/addResponse?id=<?php echo $ticket->id?>" method="post">
        <select name="user" id="">
            <?php
                foreach($allUsers as $allUser) {
                    echo '<option value='.$allUser['id'].'">'. $allUser['name'] .'</option>';
                }
            ?>   
        </select>
        <br>
        <textarea name="content" cols="30" rows="10"></textarea>
        <br>
        <button type="submit">Envoyer la response</button>
    </form>