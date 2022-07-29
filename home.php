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
    <title>Document</title>
    <link rel="stylesheet" href="./css/formstyle.css">
</head>

<body>
    <div class="cont" id="form">
        <form method="post">

            <div class="form sign-in">
                <h2>Sign In</h2>
                <label>
                    <span>Login Address</span>
                    <input type="text" name="userName">
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="userPwd">
                </label>
                <a href="index.php"></a> <button class="submit" type="submit">Sign In</button>
                <p class="forgot-pass">Forgot Password ?</p>

                <div class="social-media">
                    <ul>
                        <li><img src="img/facebook.png"></li>
                        <li><img src="img/twitter.png"></li>
                        <li><img src="img/linkedin.png"></li>
                        <li><img src="img/instagram.png"></li>
                    </ul>
                </div>
            </div>
        </form>

        <div class="sub-cont">
            <div class="img">

                <div class="img-text m-up">
                    <h2>В первый раз?</h2>
                    <p>Зарегистрируйтесь и наслаждайтесь !</p>
                </div>
                <div class="img-text m-in">
                    <h2>One of us?</h2>
                    <p>If you already has an account, just sign in. We've missed you!</p>
                </div>
                <div class="img-btn">
                    <span class="m-up">Sign Up</span>
                    <span class="m-in">Sign In</span>
                </div>
            </div>
            <div class="form sign-up">
                <form action="signup.php" method="post">

                    <h2>Sign Up</h2>
                    <label>
                        <span>Name</span>
                        <input type="text" name="userName">
                    </label>
                    <label>
                        <span>Password</span>
                        <input type="password" name="userPwd">
                    </label>
                    <label>
                        <span>Confirm Password</span>
                        <input type="password" name="confirmPwd">
                    </label>
                    <button type="submit" name="signup" class="submit">Sign Up Now</button>
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