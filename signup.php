<?php
session_start();
extract($_POST);
include("connection.php");
include("functions.php");

if (isset($_POST['signup'])) {
    $userName = $_POST['userName'];
    $userPwd = $_POST['userPwd'];

    if (!empty($userName) && !empty($userPwd) && !is_numeric($userName)) {
        if($confirmPwd != $userPwd){
            echo "Пароли не совпадают!!!";
        }else {
            $userId = random_num(20);
            $query = "insert into user (userId, userName, userPwd) values ('$userId', '$userName', '$userPwd')";
    
            mysqli_query($con, $query);
            header("Location: home.php");
            die;
        }
    } else {
        echo "Please enter some valid info!";
    }
}
?>