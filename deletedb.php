<?php
session_start();

if (!$_SESSION['user']) {
  header('Location: main.php');
}

require_once './vendor/connect.php';


$dbfordeleted = $_POST['dbfordeleted'];
$errorInfo = '';


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $sql = 'DROP DATABASE ' . $dbfordeleted . '';
  if ($connect->query($sql) === TRUE) {
    $file = './vendor/dbconfig.php';
    file_put_contents($file, '');
    unset($_SESSION['user']);
    header('Location: createdb.php');
  } else {
    $errorInfo =  $connect->error;
  }
}
?>

<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Удаление базы данных</title>
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/fonts.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/main.css">
</head>

<body>
  <div class="d-flex h-100 py-5">
    <form class="auth-form p-4 m-auto sokol-form" method="POST">
    <h4 style="margin-bottom: 2rem ">Удаление базы данных</h4>
    <?php
      if ($errorInfo) {
        echo '
          <div class="alert alert-danger my-3" role="alert">
          <p>Ошибка</p>
          ' . $errorInfo . '
          </div>
        ';
      }
      ?>
      <div class="form-group">
        <label>Подтвердите удаление базы данных</label>
        <input class="form-control" type="text" name="dbfordeleted" placeholder="Название базы данных">
        <div class="form-text my-4" style="color:red; font-size: .875em;">
          Внимание! Все заявки и пользователи будут удалены .
        </div>
      </div>
      <button name="submit" type="submit" class="btn btn-danger sokol-btn">Удалить базу данных</button>
    </form>
  </div>

  <script src="assets/js/min/jquery.min.js"></script>
  <script src="assets/js/min/popper.min.js"></script>
  <script src="assets/js/min/bootstrap.min.js"></script>
  <script src="assets/js/auth.js"></script>
</body>

</html>