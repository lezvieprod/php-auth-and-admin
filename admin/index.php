<?php
session_start();

$login = "admin";
$password = "admin";


if($login === $_SESSION['login'] && $password === $_SESSION['password'] ) {
  header('Location: content.php');
} 
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Ilya Sokol">
  <title>Main SOKOL-PHP</title>

  <link rel="icon" type="image/png" href="./images/favicon.png" />
  <link rel="stylesheet" type="text/css" href="/stylesheets/min/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="/stylesheets/min/normalize.min.css">
  <link rel="stylesheet" type="text/css" href="./stylesheets/min/fonts.min.css">
  <link rel="stylesheet" type="text/css" href="./stylesheets/main.css">
  <link rel="stylesheet" type="text/css" href="./stylesheets/min/swiper.min.css">
  <link rel="stylesheet" type="text/css" href="./stylesheets/min/aos.min.css">
</head>

<body class="page">

  <div class="container my-5 py-5" style="max-width:500px;">
    <h3 class="my-4">Авторизация в админ панели</h3>
    <form action="includes/login.php" method="POST">
      <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Логин</label>
        <input type="text" name="login" class="form-control">
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" name="password" class="form-control">
      </div>
      <button type="submit" class="btn btn-primary mr-2">Войти</button>
      <a href="/" class="btn btn-outline-secondary">Вернуться на главную</a>

    </form>
  </div>
  <script src="./js/min/jquery.min.js"></script>
  <script src="./js/min/popper.min.js"></script>
  <script src="./js/min/bootstrap.min.js"></script>

  <script src="./js/min/aos.min.js"></script>
  <script src="./js/min/swiper-bundle.min.js"></script>
  <script src="./js/all.js"></script>
</body>

</html>
