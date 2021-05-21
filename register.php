<?php
session_start();
if ($_SESSION['user']) {
  header('Location: main.php');
}

require_once './vendor/dbconfig.php';
?>



<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Авторизация и регистрация</title>
  <!-- <link rel="stylesheet" href="assets/css/main.css"> -->
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/fonts.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/main.css">
</head>

<body>
  <div class="d-flex py-5">
    <form class="auth-form p-4 m-auto">
      <h2 style="margin-bottom: 2rem ">Регистрация</h2>
      <div class="alert alert-danger d-none my-3" role="alert"></div>
      <div class="form-group">
        <label>ФИО</label>
        <input type="text" class="form-control" name="full_name" placeholder="Введите полное имя">
      </div>
      <div class="form-group">
        <label>Логин</label>
        <input type="text" class="form-control" name="login" placeholder="Введите логин">
      </div>
      <div class="form-group">
        <label>Почта</label>
        <input type="email" class="form-control" name="email" placeholder="Введите адрес почты">
      </div>
      <div class="form-group">
        <label>Изображение профиля</label>
        <input type="file" style="height: 43px;" class="form-control" name="avatar" accept="image/jpeg,image/png,image/gif">
      </div>
      <div class="form-group">
        <label>Пароль</label>
        <input type="password" class="form-control" name="password" placeholder="Введите пароль">
      </div>
      <div class="form-group">
        <label>Подтверждение пароля</label>
        <input type="password"  class="form-control" name="password_confirm" placeholder="Подтвердите пароль">
      </div>
    
      <button type="submit" class="btn btn-primary btn-block register-btn">Зарегистрироваться</button>
      <div class="my-3 text-center">
        или
      </div>
      <a class="btn btn-outline-primary btn-block" href="/"> Войти </a>
    </form>
  </div>
  <script src="assets/js/min/jquery.min.js"></script>
  <script src="assets/js/auth.js"></script>
</body>

</html>