<?php

function connectDB(){
    return new mysqli("localhost", "root", "", "usersbase");
}

function closeDB($mysqli){
    $mysqli->close();
}


function check_login($con)
{

    if (isset($_SESSION['userId'])) {

        $id = $_SESSION['userId'];
        $query = "select * from user where userId = '$id' limit 1";

        $result = mysqli_query($con, $query);
        if ($result && mysqli_num_rows($result) > 0) {

            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    header("Location: index.php");
    die;
}

function random_num($length)
{

    $text = "";
    if ($length < 5) {
        $length = 5;
    }

    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {
        # code...

        $text .= rand(0, 9);
    }

    return $text;
}


function getWallpaper($userName){
    // $mysqli = ConnectDB();
    $mysqli = new mysqli("localhost", "root", "", "usersbase");
    $result_set = $mysqli->query("select wallpaper from user where userName = '$userName'");
    $row = $result_set->fetch_assoc();
    closeDB($mysqli);
    return $row["wallpaper"];



    // printf("Запрос SELECT вернул %d строк.\n", $result->num_rows);




    // $query = "SELECT `wallpaper` FROM `user` WHERE `userName` = `$userName`";
    // $result_set = $mysqli->query($query);
    
    // closeDB($mysqli);
    // return $row["wallpaper"];

    // mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // $result_set = $mysqli->query("select `wallpaper` from `user` where userName = $userName");
    // $row = $result_set->fetch_assoc();
    // return $row["wallpaper"];

    // return $row["wallpaper"];
    // $mysqli = connectDB();
    // $result_set = $query("SELECT 'wallpaper' FROM 'user' WHERE 'userName' = '$userName'");
    // $row = $result_set->fetch_assoc();
    // return $row["wallpaper"];
    // if ($result && mysqli_num_rows($result) > 0) {
        
    //     $row = mysqli_fetch_assoc($result);
    //     closeDB($con);
    // }
    
    // $result = mysqli_query($con, $query);
    // $result_set = $mysqli->query("SELECT 'wallpaper' FROM 'user' WHERE 'userName' = '$userName'");
    // $row = $result_set->fetch_assoc();
    // return $row["wallpaper"];
}

function isSecurity($wallpaper){
    $name = $wallpaper["name"];
    $type = $wallpaper["type"];
    $size = $wallpaper["size"];
    $blacklist = array(".php", ".phtml", ".php3", ".php4");
    foreach ($blacklist as $item){
        if(preg_match("/$item\$/i", $name)) return false; //Для проверки на недоброжелательные файлы
    }

    if(($type == !"image/gif") && ($type !="image/png") && ($type != "image/jpg") && ($type != "image/jpeg")) {
        return false;
    }

    if($size > 5 * 1024 * 1024) return false;
    return true;
}

function loadWall($wallpaper, $userName){
    $type = $wallpaper["type"];
    $uploaddir = "wallpaper/";
    $name = md5(microtime()).".".substr($type, strlen("image/")); //создаём имя файла
    $uploadfile = $uploaddir.$name;

    if(move_uploaded_file($wallpaper["tmp_name"], $uploadfile)){
        setWall($userName, $name);
        return true;
    }   
    else return false;
}

function setWall($userName, $name){
    // $con = mysqli_connect("localhost", "root", "", "usersbase");

    $mysqli = connectDB();
    // $mysqli->query = "UPDATE 'user' SET 'wallpaper' = '$name' WHERE 'userName' = '$userName'";
    // closeDB($mysqli);

    
    $con = mysqli_connect("localhost", "root", "", "usersbase");
    
    $query = "UPDATE user SET wallpaper = '$name' WHERE userName = '$userName'";
    mysqli_query($con, $query);
}