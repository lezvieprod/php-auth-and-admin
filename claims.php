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
        <header class=" mb-5">
            <div class="inner">
                <h3 class="masthead-brand">Мои заявки</h3>
                <nav class="nav nav-masthead justify-content-center">
                    <a class="nav-link" href="profile.php">Профиль</a>
                    <a class="nav-link active" href="#">Мои завяки</a>
                    <a class="nav-link" href="/">На главную</a>
                </nav>
            </div>
        </header>

        <main role="main" class="inner cover">
        <table class="table table-striped table-dark table-md">
        <?php
            if (mysqli_num_rows($claims)) {
              echo ' 
                  <thead>
                    <tr data-aos="fade-left" >
                      <th style="min-width: 50px; ">ID</th>
                      <th style="min-width: 100px; ">Автор</th>
                      <th style="min-width: 250px;">Название</th>
                      <th >Текст заявки</th>
                    </tr>
                  </thead>
                <tbody>
                ';
              while ($claim = mysqli_fetch_assoc($claims)) {
                echo '
                    <tr data-aos="fade-right">
                      <td >' . $claim["id"] . '</td>
                      <td >' . $claim["author"] . '</td>
                      <td >' . $claim["title"] . '</td>
                      <td>' . $claim["value"] . '</td>
                    </tr>
                    ';
              };
              echo '</tbody>';
            } else {
              echo '<h3 class="text-center">Новых заявок нет!</h3>';
            }
            ?>
          </tbody>
        </table>
        </main>

        <footer class="mastfoot mt-auto">
            <div class="inner">

            </div>
        </footer>
    </div>


</body>

</html>