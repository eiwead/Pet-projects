<?php

session_start();
include("connection.php");
include("functions.php");
if(isset($_POST["changewall"])){
    $wallpaper = $_FILES["wallpaper"];
    if(isSecurity($wallpaper)) loadWall($wallpaper, $_SESSION["userName"]);
    else $message ="error";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change wallpaper</title>
</head>

<body>
<table border="1" width="100%" cellpadding ='0' cellspacing='0'>
    <tr>
        <td colspan="2">
            <!-- <img src="./img/picture.jpg" alt="hat"> -->
        </td>
    </tr>
    <tr>
        <td style="width: 80%;">
    <div style="text-align: center;">
    <?php
    if(isset($message)){
        echo "<p style='color: red;'> $message </p>";
        unset($message);
    }
    ?>
        <h1>Change wallpaper</h1>
        <form id="form1" action="changewall.php" method="post" enctype="multipart/form-data">
            <p><input type="file" name="wallpaper"></p>
            <p><input type="submit" name="changewall" value="Change"></p>
        </form>
        <a href="index.php">Вернуться</a>
    </div>
</td>
    </tr>
</table>    
</body>
</html>