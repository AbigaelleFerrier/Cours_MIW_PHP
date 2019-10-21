<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Upload file</title>
</head>
<body>
    <?php 
        if (isset($_GET['code'])) {
            echo "<p>" . $_GET['code'] . "<p>";
        }
    ?>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="photo" id="photo">
        <button type="submit">Envoyer</button>
    </form>


    <?php 
        $pdf = scandir('img/pdf');
        $jpg = scandir('img/jpg_png');
        $gif = scandir('img/gif');
        
        echo "<p>PDF</p><ul>";
            foreach ($pdf as $value) {
                echo '<li><a href="img/pdf/'. $value .'">' . $value . '</a></li>';
            }
        echo "</ul>";

        echo "<p>JPG PNG</p><ul>";
            foreach ($jpg as $value) {
                echo '<li><a href="img/jpg_png/'. $value .'">' . $value . '</a></li>';
            }
        echo "</ul>";

        echo "<p>GIF</p><ul>";
            foreach ($gif as $value) {                
                echo '<li><a href="img/gif/'. $value .'">' . $value . '</a></li>';
            }
        echo "</ul>";
    ?>



</body>
</html>