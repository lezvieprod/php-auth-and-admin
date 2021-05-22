<?php
session_start();
error_reporting(0);

if ($_SESSION['user']) {
  header('Location: register.php');
}

require_once './vendor/dbconfig.php';

if($dbinit && $sokol === 'init') {
  header('Location: /');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $servername = $_POST['servername'];
  $dbname = $_POST['dbname'];
  $dblogin = $_POST['rootlogin'];
  $dbpass = $_POST['rootpass'];
  $PMAconnect = mysqli_connect($servername, $dblogin, $dbpass);
  if (!mysqli_connect_errno()) {
    if ($PMAconnect->query("CREATE DATABASE $dbname") === TRUE) {
      $DBconnect = mysqli_connect($servername, $dblogin, $dbpass, $dbname);
      $sql = "CREATE TABLE claims (
        id INT(1) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        author text NOT NULL,
        title VARCHAR(200),
        value text,
        newValue text,
        status int(0) NOT NULL
        )";
      $sql2 = "CREATE TABLE users (
        id INT(1) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(355),
        login VARCHAR(100),
        email VARCHAR(255),
        password VARCHAR(500),
        avatar VARCHAR(500),
        user_group INT(0) NOT NULL
        )";
      if ($DBconnect->query($sql) === TRUE && $DBconnect->query($sql2) === TRUE) {
        header('Location: register.php');
        $file = './vendor/dbconfig.php';
        $current = file_get_contents($file);
        $current .= '<?php 
          session_start();
          $dbinit = true;
          $servername = "'. $servername .'";
          $dblogin = "'. $dblogin .'";
          $dbpass = "'. $dbpass .'";
          $dbname = "'. $dbname .'";
          $sokol = "init";
        ?>';
          file_put_contents($file, $current);
      } else {
        echo "Error creating table: " . $DBconnect->error;
      }
    } else {
      echo "Error creating database: " . $conn->error;
    }
  }
}

?>

<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <title>Создание базы данных</title>
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/fonts.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/main.css">
</head>

<body>
  <div class="d-flex h-100 py-5">
    <form class="create-db-form p-4 m-auto" method="POST">
      <h4 style="margin-bottom: 2rem ">Создание базы данных</h4>
      <?php
      if (mysqli_connect_errno()) {
        echo '
          <div class="alert alert-danger my-3" role="alert">
          <p>Ошибка</p>
          <p>' . mysqli_connect_error() . '</p>
          Проверьте правильность заполнения полей
          </div>
        ';
      }
      ?>

      <div class="form-group">
        <label>Сервер</label>
        <input type="text" class="form-control" name="servername" required>
        <div class="form-text" style="color: #6c757d; font-size: .875em;">
          Обычно 'localhost'
        </div>
      </div>
      <div class="form-group">
        <label>Название базы данных</label>
        <input type="text" class="form-control" name="dbname" required>
      </div>
      <div class="form-group">
        <label>Логин</label>
        <input type="text" class="form-control" name="rootlogin" required>
        <div class="form-text" style="color: #6c757d; font-size: .875em;">
          Обычно 'root'
        </div>
      </div>
      <div class="form-group">
        <label>Пароль</label>
        <input type="password" class="form-control sokol-pass" name="rootpass">
        <div class="form-text" style="color: #6c757d; font-size: .875em;">
          Обычно 'root' или без пароля
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Создать</button>
    </form>
  </div>

  <script src="assets/js/min/jquery.min.js"></script>
  <script src="assets/js/min/popper.min.js"></script>
  <script src="assets/js/min/bootstrap.min.js"></script>
  <script src="assets/js/auth.js"></script>
</body>

</html>

<?php //soKol ?>