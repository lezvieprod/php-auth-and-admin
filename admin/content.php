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
  <link rel="stylesheet" type="text/css" href="../assets/stylesheets/min/normalize.min.css">

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
                <a class="dropdown-item" href="../vendor/logout.php">Выйти из аккаунта</a>
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
          <h2 class="my-5">Заявки пользователей</h2>
          <table class="table table-striped table-md">
            <?php
            if (mysqli_num_rows($claims)) {
              echo ' 
                  <thead>
                    <tr data-aos="fade-left" >
                      <th style="min-width: 50px; ">ID</th>
                      <th style="min-width: 100px; ">Автор</th>
                      <th style="min-width: 250px;">Название</th>
                      <th >Текст заявки</th>
                      <th class="text-center">Действия</th>
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
                      <td style="width: 80px; ">
                        <div class="dropdown text-center my-3">
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Управление
                        </button>
                          <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="./update.php?id=' . $claim['id'] . '">Изменить</a></li>
                            <li><a class="dropdown-item" href="includes/delete-claim.php?id=' . $claim['id'] . '">Удалить</a></li>
                          </ul>
                        </div>
                      </td>
                    </tr>
                    ';
              };
              echo '</tbody>';
            } else {
              echo '<h3 class="text-center">Новых заявок нет!</h3>';
            }
            ?>
          </table>
          <div class="container" style="max-width: 700px">
            <div class="my-5 pb-5">
              <div class="my-4">
                <h3 class="my-0">Добавить новую заявку</h3>
              </div>
              <form action="includes/add-claim.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                  <input class="form-control" type="text" name="title" placeholder="Название заявки">
                </div>
                <div class="form-group">
                  <select id="data-type" name="type" class="form-control">
                    <option value="1" selected>Текст</option>
                    <option value="2">Изображение</option>
                  </select>
                </div>
                <div class="form-group" id="text-form">
                  <textarea class="form-control" type="text" name="value" placeholder="Содержимое"></textarea>
                </div>
                <div class="form-group" id="image-form" style="display:none">
                  <label class="form-label" for="image">Изображение</label>
                  <input class="form-control" name="image" id="image" type="file">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Добавить заявку</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </main>
    </div>
  </div>


  <script>
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
  </script>

  <script src="../assets/js/min/jquery.min.js"></script>
  <script src="../assets/js/min/popper.min.js"></script>
  <script src="../assets/js/min/bootstrap.min.js"></script>

</body>

</html>