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
    <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/fonts.min.css">
    <link rel="stylesheet" href="assets/css/profile.css">
    <link rel="stylesheet" type="text/css" href="../assets/stylesheets/main.css">

</head>

<body>
    <header class="navbar navbar-expand-lg navbar-dark bg-dark primary-color w-100 mb-5">
        <div class="container" style="max-width: 1200px">
            <a class="navbar-brand" href="/profile.php">Мой профиль</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mr-3">
                        <a class="nav-link active" href="profile.php">Профиль</a>
                    </li>
                    <li class="nav-item mr-3">
                        <a class="nav-link" href="claims.php">Мои заявки</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">На главную</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="container" style="max-width: 1200px">
        <main role="main" class="inner profile-body p-5 d-flex flex-wrap">
            <div class="d-flex align-center align-items-center mr-5">
                <div class="avatar">
                    <img src="<?= $_SESSION['user']['avatar'] ?>" alt="" />
                </div>
            </div>
            <div>
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

                <p class="lead mt-5">
                    <a href="claims.php" class="btn btn-lg btn-dark">Мои заявки</a>
                    <a href="vendor/logout.php" class="btn btn-lg btn-outline-dark">Выход из аккаунта</a>
                </p>
            </div>
        </main>
    </div>

    <footer class="mastfoot mt-auto">
        <div class="inner">

        </div>
    </footer>



</body>

</html>