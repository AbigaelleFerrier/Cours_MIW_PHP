<?php
require 'config.php';//chemin d'accès
$bdd = getDB();


$reqUser = $bdd->query('SELECT * FROM `user`');
$users = $reqUser->fetchAll(PDO::FETCH_ASSOC);
?>
    <table>
    <tr>
        <td>NOM</td>
        <th>MAIL</th>
    </tr>

<?php
foreach ($users as $user) { ?>
    <tr>
        <form action="saveUser.php?id=<?php echo $user['id'] ?>" method="post">
            <td><input type="text" name="name"  value="<?php echo $user['name'] ?>"></td>
            <td><input type="text" name="email" value="<?php echo $user['email'] ?>"></td>
            <td><button type="submit">SAVE</button></td>
            <td><a href="delUser.php?id=<?php echo $user['id'] ?>">DELETE</a></td>
        </form>
    </tr>
<?php } ?>

    </table>


<hr>
<h2>ADD USER</h2>
<form action="addUser.php" method="post">
    <input type="text" name="name" value="TestName">
    <input type="text" name="email" value="TestEmail">
    <button type="submit">ADD</button>
</form>