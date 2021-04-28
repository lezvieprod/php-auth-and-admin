<?php
session_start();

if ($_SESSION['user']) {
  header('Location: main.php');
}

?>

<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Авторизация и регистрация</title>
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/fonts.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/main.css">
</head>

<body>
  <div class="d-flex h-100 py-5">
    <form class="auth-form p-4 m-auto">
      <h2 style="margin-bottom: 2rem ">Авторизация</h2>
      <div class="alert alert-danger d-none my-3" role="alert"></div>
      <div class="form-group">
        <label>Логин</label>
        <input type="text" class="form-control" name="login" placeholder="Введите логин">
      </div>
      <div class="form-group">
        <label>Пароль</label>
        <input type="password" class="form-control" name="password" placeholder="Введите пароль">
      </div>
      <button type="submit" class="btn btn-primary btn-block btn-sumbit">Войти</button>
      <div class="my-3 text-center">
        или
      </div>
      <a class="btn btn-outline-primary btn-block" href="/register.php"> Регистрация </a>
    </form>
  </div>

  <script src="assets/js/min/jquery.min.js"></script>
  <script src="assets/js/min/popper.min.js"></script>
  <script src="assets/js/min/bootstrap.min.js"></script>
  <script src="assets/js/auth.js"></script>
</body>
</html>