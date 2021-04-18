<?php
session_start();
if (!$_SESSION['user']) {
    header('Location: /');
}
require_once 'vendor/connect.php';


$author = $_SESSION['user']['login'];
$claims = mysqli_query($connect, "SELECT * FROM `claims` WHERE `author` = '$author'");


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Авторизация и регистрация</title>
    <link rel="icon" type="image/png" href="./images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/normalize.min.css">
    <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/fonts.min.css">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>

<body>
    <div class="background" > </div>
    <div class="cover-container d-flex h-100 p-3 w-100 mx-auto flex-column">
        <header class="masthead mb-auto">
            <div class="inner">
                <h3 class="masthead-brand">Профиль</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link active" href="profile.php">Профиль</a>
                    <a class="nav-link " href="claims.php">Мои завяки</a>
                    <a class="nav-link" href="/">На главную</a>
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
            <h1 class="cover-heading"><?= $_SESSION['user']['login'] ?></h1>
            <p class="lead"><?= $_SESSION['user']['full_name'] ?></p>
            <p class="lead"><?= $_SESSION['user']['email'] ?></p>
            <p class="lead">
                <?php
                if ($_SESSION['user']['user_group'] === '0') {
                    echo '<span>Пользователь</span>';
                } else {
                    echo '<span style="color:red">Администратор</span>';
                }

                ?>
            </p>

            <p class="lead">
                <a href="claims.php" class="btn btn-lg btn-secondary">Мои заявки</a>
                <a href="vendor/logout.php" class="btn btn-lg btn-outline-secondary">Выход из аккаунта</a>
            </p>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">

            </div>
        </footer>
    </div>


</body>

</html>