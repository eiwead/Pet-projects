<?php
session_start();
include("connection.php");
include("functions.php");

// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     $userName = $_POST['userName'];
//     $userPwd = $_POST['userPwd'];

//     if (!empty($userName) && !empty($userPwd) && !is_numeric($userName)) {

//         $query = "select * from user where userName = '$userName'";
//         $result = mysqli_query($con, $query);

//         if ($result) {
//             if ($result && mysqli_num_rows($result) > 0) {

//                 $user_data = mysqli_fetch_assoc($result);

//                 if ($user_data['userPwd'] === $userPwd) {
//                     $_SESSION['userId'] = $user_data['userId'];

//                     $_SESSION['userName'] = $userName;
//                     $wallpaper = getWallpaper($_SESSION['userName']);
//                     if ($wallpaper == "") {
//                         $wallpaper = "default.jpg";
//                     }
//                     echo "<img src='./wallpaper/$wallpaper' alt='background' />";
//                     echo "Здравствуйте ", $_SESSION['userName'];
//                     header("Location: index.php");
//                 } else {
//                     header("Location: error.php");
//                 }
//             }
//         }
//         echo "wrong username or password!";
//     } else {
//         echo "Wrong username or password!";
//         // header("Location: error.php");
//     }
// }




// if ($_SERVER['REQUEST_METHOD'] == "POST") {
//     $user_name = $_POST['userName'];
//     $password = $_POST['userPwd'];

//     if (!empty($user_name) && !empty($userPwd) && !is_numeric($userName)) {
//         $userId = random_num(20);
//         $query = "insert into users (userId, userName, userPwd) values ('$userId', '$userName', '$userPwd')";

//         mysqli_query($con, $query);

//         // header("Location: login.php");
//         die;
//     } else {
//         echo "Please enter some valid info!";
//     }
// }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,800&display=swap" rel="stylesheet">
    <title>Screensaver</title>
</head>

<body>
    <div class="container">
        <div class="hello">
            <?php
            $user = $_SESSION['userName'];
            $wallpaper = getWallpaper($_SESSION['userName']);
            if ($wallpaper == "") {
                $wallpaper = "default.jpg";
            }

            echo
            "<div>
            <p>Здравствуйте $user</p>
        </div>
                <style type='text/css'>
            html {
                background: url('./wallpaper/$wallpaper') no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
        </style>"

            // echo "<img src='./wallpaper/$wallpaper' height=1080px width=1920px alt='background' />";
            // echo "<p>Здравствуйте $user</p>";
            ?>
        </div>

        <div class="weather">
            <?php
            // кодировка страницы
            header('Content-Type: text/html;charset=UTF-8');

            $city = "Нижневартовск"; // город. Можно и по-русски написать, например: Брянск
            $country = "RU"; // страна
            $mode = "json"; // в каком виде мы получим данные json или xml
            $units = "metric"; // Единицы измерения. metric или imperial
            $lang = "ru"; // язык
            $countDay = 1; // количество дней. Максимум 14 дней
            $appID = "7755d35b385026502314a25fa2b6e379"; // Ваш APPID

            // формируем урл для запроса
            $url = "http://api.openweathermap.org/data/2.5/forecast?q=$city,$country&cnt=$countDay&lang=$lang&units=$units&appid=$appID";       // делаем запрос к апи
            $data = @file_get_contents($url);
            // если получили данные
            if ($data) {
                // декодируем полученные данные
                $dataJson = json_decode($data);
                // получаем только нужные данные
                $arrayDays = $dataJson->list;
                // выводим данные
                foreach ($arrayDays as $oneDay) {
                    echo "Город: " . $city . "<br/>";
                    echo "Скорость ветра: " . $oneDay->wind->speed . "<br/>";
                    echo "Погода: " . $oneDay->weather[0]->description . "<br/>";
                    echo "Давление: " . $oneDay->main->pressure . "<br/>";
                    echo "Влажность: " . $oneDay->main->humidity . "<br/>";
                    echo "Температура: " . $oneDay->main->temp . "<br/>";
                }
            } else {
                echo "Сервер не доступен!";
            }

            // Если вдруг понадобится что-то добавить 
            // {"coord":{"lon":34.3806,"lat":53.2875},
            // "weather":[{"id":520,"main":"Rain","description":"light intensity shower rain","icon":"09d"}],
            // "base":"stations",
            // "main":{"temp":289.46,"feels_like":289.29,"temp_min":289.46,"temp_max":289.46,"pressure":1018,"humidity":82},
            // "visibility":4700,"wind":{"speed":3,"deg":280},"clouds":{"all":75},"dt":1658223131,
            // "sys":{"type":1,"id":9019,"country":"RU","sunrise":1658194714,"sunset":1658253513},
            // "timezone":10800,"id":571476,"name":"Bryansk","cod":200}
            ?>
        </div>

        <div class="abilities">
            <a href="changewall.php" title='Edit wallpaper'><img id="btn" src="https://api.iconify.design/cil/wallpaper.svg?color=white" width="50" alt=""></a>
            <!-- <li>Настройки</li> Мб что-нибудь придумаю -->
        </div>

        <div class="login">
            <a href="home.php"><img id="btn" src="https://api.iconify.design/ant-design/login-outlined.svg?color=white" width="50" alt=""></a>
            <!-- <button id="btn">
                Войти/зарегистрироваться
            </button> -->
        </div>
    </div>

    <!-- <div class="center" id="form">
        <div class="text">Приветствуем!</div>
        <form method="post">
            <div class="data">
                <label>Имя</label>
                <input type="text" name="userName">
            </div>
            <div class="data">
                <label>Пароль</label>
                <input type="password" name="userPwd">
            </div>
            <div class="btn">
                <div class="inner"></div>
                <button type="submit">Войти</button>
            </div>
        </form>
        <div class="signup-link">Впервые здесь? <a href="signup.php">Зарегистрироваться</a></div>
    </div> -->

    <!-- <div class="cont" id="form">
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
                <button class="submit" type="submit">Sign In</button>
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
                    <h2>New here?</h2>
                    <p>Sign up and discover great amount of new opportunities!</p>
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
    </div> -->

    <!-- <div class="center" id="register">
        <div class="text">Регистрация</div>
        <form method="post">
            <div class="data">
                <label>Имя</label>
                <input type="text" required name="userName">
            </div>
            <div class="data">
                <label>Пароль</label>
                <input type="text" required name="userPwd">
            </div>
            <div class="forgot-pass"><a href="#">Забыли пароль?</a></div>
            <div class="btn">
                <div class="inner"></div>
                <button type="submit" value="Signup">Войти</button>
            </div>
        </form>
        <div class="signup-link">Впервые здесь? <a href="#">Зарегистрироваться</a></div>
    </div> -->

</body>

</html>

<script>
    // Чтобы при нажатии вылазила форма

    // const btn = document.getElementById('btn');

    // btn.addEventListener('click', () => {
    //     const form = document.getElementById('form');

    //     if (form.style.display === 'none') {
    //         // 👇️ this SHOWS the form
    //         form.style.display = 'block';
    //     } else {
    //         // 👇️ this HIDES the form
    //         form.style.display = 'none';
    //     }
    // });
</script>