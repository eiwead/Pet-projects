<?php

session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $userName = $_POST['userName'];
    $userPwd = $_POST['userPwd'];

    if (!empty($userName) && !empty($userPwd) && !is_numeric($userName)) {

        $query = "select * from user where userName = '$userName'";
        $result = mysqli_query($con, $query);

        if ($result) {
            if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);

                if ($user_data['userPwd'] === $userPwd) {
                    $_SESSION['userId'] = $user_data['userId'];

                    $_SESSION['userName'] = $userName;
                    $wallpaper = getWallpaper($_SESSION['userName']);
                    if ($wallpaper == "") {
                        $wallpaper = "default.jpg";
                    }
                    echo "<img src='./wallpaper/$wallpaper' alt='background' />";
                    echo "Здравствуйте ", $_SESSION['userName'];
                    header("Location: index.php");
                } else {
                    header("Location: error.php");
                }
            }
        }
        echo "Неправылной логин или пароль!";
    } else {
        echo "Неправылной логин или пароль!";
        // header("Location: error.php");
    }
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WelCUM</title>
    <link rel="stylesheet" href="./css/formstyle.css">
</head>

<body>
    <div class="cont" id="form">
        <form method="post">

            <div class="form sign-in">
                <h2>Вход</h2>
                <label>
                    <span>Логин</span>
                    <input type="text" name="userName">
                </label>
                <label>
                    <span>Пароль</span>
                    <input type="password" name="userPwd">
                </label>
                <a href="index.php"></a> <button class="submit" type="submit">Войти</button>
                <!-- <p class="forgot-pass">Forgot Password ?</p> -->

                <div class="social-media">
                    <ul>
                        <li> <a href=""><img src="https://api.iconify.design/cib/vk.svg?color=blue"></a> </li>
                        <li> <a href=""><img src="https://api.iconify.design/akar-icons/github-fill.svg"></a> </li>
                        <li> <a href=""><img src="https://api.iconify.design/logos/telegram.svg"></a> </li>
                        <li> <a href=""><img src="https://api.iconify.design/entypo-social/youtube-with-circle.svg?color=red"></a> </li>
                    </ul>
                </div>
            </div>
        </form>

        <div class="sub-cont">
            <div class="img">

                <div class="img-text m-up">
                    <h2>В первый раз?</h2>
                    <p>Зарегистрируйтесь!!!!</p>
                </div>
                <div class="img-text m-in">
                    <h2>Уже были здесь?!</h2>
                    <p>При наличии аккаунта вам необходимо только войти</p>
                </div>
                <div class="img-btn">
                    <span class="m-up">Создать</span>
                    <span class="m-in">Войти</span>
                </div>
            </div>
            <div class="form sign-up">
                <form action="signup.php" method="post">

                    <h2>Зарегистрироваться</h2>
                    <label>
                        <span>Логин</span>
                        <input type="text" name="userName">
                    </label>
                    <label>
                        <span>Пароль</span>
                        <input type="password" name="userPwd">
                    </label>
                    <label>
                        <span>Подтвердите пароль</span>
                        <input type="password" name="confirmPwd">
                    </label>
                    <button type="submit" name="signup" class="submit">Зарегистрироваться</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    document.querySelector('.img-btn').addEventListener('click', function() {
        document.querySelector('.cont').classList.toggle('s-signup')
    });
</script>