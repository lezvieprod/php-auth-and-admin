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
  <link rel="stylesheet" type="text/css" href="../assets/stylesheets/main.css">
</head>

<body style="background-color: #f6f6f6;">
  <header class="navbar navbar-expand-lg navbar-dark bg-dark primary-color w-100 mb-5">
    <div class="container" style="max-width: 1200px">
      <a class="navbar-brand" href="/claims.php">Мои заявки</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item mr-3">
            <a class="nav-link" href="profile.php">Профиль</a>
          </li>
          <li class="nav-item mr-3">
          <a class="nav-link active" href="#">Мои заявки</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/">На главную</a>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <main role="main" class="inner">
    <div class="container" style="max-width: 1200px">
      <div class="row">
        <?php
        if (mysqli_num_rows($claims)) {

          while ($claim = mysqli_fetch_assoc($claims)) {

            $statusText = $claim["status"] === '1' ? 'Устранено' : 'В обработке';
            $statusClass = $claim["status"] === '1' ? 'status-open' : 'status-closed';
            $imageBeforeSrcRender = $claim["value"] === '' ? 'assets/images/noimage.png' : $claim["value"];
            $imageAfterSrcRender = $claim["newValue"] === '' ? 'assets/images/noimage.png' : $claim["newValue"];
            $renderSecondImage;

            if ($claim["status"] === '1') {
              $renderSecondImage = '
                <div class="claim__item__header__image-second">
                  <img src="' . $imageAfterSrcRender . '" alt="После">
                  <div class="claim__item__header__image-description">После</div>
                </div>
                ';
            } else {
              $renderSecondImage = '';
            };
            echo '
              <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-right" data-claim-id="' . $claim["id"] . '">
                <div class="claim__item">
                  <div class="claim__item__header" data-sokol>
                    <div class="claim__item__header__image-first">
                      <img src="' . $imageBeforeSrcRender . '" alt="До">
                      <div class="claim__item__header__image-description">До</div>
                    </div>
                    ' . $renderSecondImage . '
                    
                  </div>
                  <div class="claim__item__body">
                    <div class="claim__item__body__status ' . $statusClass . '">
                    ' . $statusText . '
                    </div>
                    <div class="claim__item__body__title">
                    ' . $claim["title"] . '
                    </div>
                    <div class="claim__item__body__subtitle">
                      Автор: ' . $claim["author"] . '
                    </div>
                  </div>
                </div>
              </div>
                    ';
          };
        } else {
          echo '<h3 class="text-center w-100">Вы не добавили ни одной заявки</h3>';
        }
        ?>
      </div>
    </div>
  </main>

  <footer class="mastfoot mt-auto">
    <div class="inner">

    </div>
  </footer>



</body>

</html>