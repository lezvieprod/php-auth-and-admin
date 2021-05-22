<?php
session_start();

if (!$_SESSION['user']) {
  header('Location: /');
}
if ($_SESSION['user']['user_group'] === '0') {
  header('Location: /');
}


require_once '../vendor/connect.php';
$claims = mysqli_query($connect, "SELECT * FROM `claims` ");
$claimsCompletedLength = mysqli_query($connect,"SELECT `status` FROM `claims` WHERE status = 1");
$claimsProcessingLength = mysqli_query($connect,"SELECT `status` FROM `claims` WHERE status = 0");



?>


<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.80.0">
  <title>Admin Dashboard SOKOL-PHP</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" type="text/css" href="../assets/stylesheets/min/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/stylesheets/min/fonts.min.css">
  <link rel="stylesheet" type="text/css" href="../assets/stylesheets/main.css">
  <!-- Favicons -->

  <meta name="theme-color" content="#7952b3">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>

  <style type="text/css">
    /* Chart.js */
    @keyframes chartjs-render-animation {
      from {
        opacity: .99
      }

      to {
        opacity: 1
      }
    }

    .chartjs-render-monitor {
      animation: chartjs-render-animation 1ms
    }

    .chartjs-size-monitor,
    .chartjs-size-monitor-expand,
    .chartjs-size-monitor-shrink {
      position: absolute;
      direction: ltr;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      overflow: hidden;
      pointer-events: none;
      visibility: hidden;
      z-index: -1
    }

    .chartjs-size-monitor-expand>div {
      position: absolute;
      width: 1000000px;
      height: 1000000px;
      left: 0;
      top: 0
    }

    .chartjs-size-monitor-shrink>div {
      position: absolute;
      width: 200%;
      height: 200%;
      left: 0;
      top: 0
    }
  </style>
</head>

<body style="overflow-x:hidden">

  <header class="navbar navbar-expand-lg navbar-dark bg-dark primary-color w-100">
    <div class="container" style="max-width: 1200px">
      <a class="navbar-brand" href="content.php">Панель управления</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <div class="header-dropdown btn-group dropleft">
              <a type="button" class="nav-link text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?= $_SESSION['user']['login'] ?>
              </a>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="../profile.php">Мой профиль</a>
                <a class="dropdown-item" href="../main.php">На главную</a>
                <a class="dropdown-item" href=".././vendor/logout.php">Выйти из аккаунта</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <main class="col-md-12 ms-sm-auto col-lg-12 px-md-4">
        <div class="container" style="max-width: 1200px">
          <div class="text-center mt-5">
            <div>
              Всего: 
              <span style="font-weight: 700">
                <?= mysqli_num_rows($claims) ?>
              </span>
            </div>
            <div>
              Обработанных:
               <span style="color: green; font-weight: 700">
                <?= mysqli_num_rows($claimsCompletedLength)?>
               </span>
            </div>
            <div>
              Не обработанных:
               <span style="color: red; font-weight: 700">
                <?= mysqli_num_rows($claimsProcessingLength)?>
               </span>
            </div>
          </div>
          <h2 class="mb-5 mt-2 text-center w-100">Заявки пользователей</h2>
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
                  <img src="../' . $imageAfterSrcRender . '" alt="После">
                  <div class="claim__item__header__image-description">После</div>
                </div>
                ';
                } else {
                  $renderSecondImage = '';
                };
                echo '
              <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-right" data-claim-id="' . $claim["id"] . '">
                <div class="claim__item">
                  <div class="claim__item__header">
                    <div class="claim__item__header__image-first">
                      <img src="../' . $imageBeforeSrcRender . '" alt="До">
                      <div class="claim__item__header__image-description">До</div>
                    </div>
                    ' . $renderSecondImage . '
                    <div class="claim__item__header__control">
                      <div class="dropdown dropleft text-center">
                        <button class="btn btn-dark btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Управление
                        </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="./update.php?id=' . $claim['id'] . '">Изменить</a></li>
                            <li><a class="dropdown-item" href="includes/delete-claim.php?id=' . $claim['id'] . '">Удалить</a></li>
                          </ul>
                      </div>
                    </div>
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
                    <div class="claim__item__body__subtitle">
                      Заявка: №' . $claim["id"] . '
                    </div>
                  </div>
                </div>
              </div>
                    ';
              };
            } else {
              echo '<h3 class="text-center w-100">Новых заявок нет!</h3>';
            }
            ?>
          </div>

          <div class="container" style="max-width: 700px">
            <div class="my-5">
              <h3 class="my-0">Добавить новую заявку</h3>
            </div>
            <form action="includes/add-claim.php" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <input class="form-control" type="text" name="title" placeholder="Название заявки">
              </div>
              <div class="form-group" id="image-form">
                <label class="form-label" for="image">Изображение</label>
                <input class="form-control" style="height: 43px;" name="image" id="image" type="file" accept="image/jpeg,image/png,image/gif">
              </div>
              <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary">Добавить заявку</button>
              </div>
            </form>

            <div class="my-5">
              <h5 class="my-3">Дополнительные настройки</h5>
              <a href="../deletedb.php" class="btn btn-danger">Удалить базу данных</a>
            </div>
          </div>

        </div>
      </main>
    </div>
  </div>


  <!-- <script>
    let select = document.getElementById("data-type");
    let textForm = document.getElementById("text-form");
    let imageForm = document.getElementById("image-form");


    select.addEventListener('change', function() {
      if (select && select.value == 1) {
        textForm.style.display = "block"
        imageForm.style.display = "none"
      } else if (select && select.value == 2) {
        textForm.style.display = "none"
        imageForm.style.display = "block"
      }
    })
  </script> -->

  <script src="../assets/js/min/jquery.min.js"></script>
  <script src="../assets/js/min/popper.min.js"></script>
  <script src="../assets/js/min/bootstrap.min.js"></script>

</body>

</html>