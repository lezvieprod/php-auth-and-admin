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
    <div class="container-fluid">
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
                <a class="dropdown-item" href="vendor/logout.php">Выйти из аккаунта</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse" style="min-height: 100vh;">
        <div class="position-sticky pt-3">
          <ul class="nav flex-column">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                  <polyline points="9 22 9 12 15 12 15 22"></polyline>
                </svg>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                  <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                  <polyline points="13 2 13 9 20 9"></polyline>
                </svg>
                Orders
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart">
                  <circle cx="9" cy="21" r="1"></circle>
                  <circle cx="20" cy="21" r="1"></circle>
                  <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                </svg>
                Products
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                  <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                  <circle cx="9" cy="7" r="4"></circle>
                  <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                  <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                </svg>
                Customers
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2">
                  <line x1="18" y1="20" x2="18" y2="10"></line>
                  <line x1="12" y1="20" x2="12" y2="4"></line>
                  <line x1="6" y1="20" x2="6" y2="14"></line>
                </svg>
                Reports
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-layers">
                  <polygon points="12 2 2 7 12 12 22 7 12 2"></polygon>
                  <polyline points="2 17 12 22 22 17"></polyline>
                  <polyline points="2 12 12 17 22 12"></polyline>
                </svg>
                Integrations
              </a>
            </li>
          </ul>

          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="link-secondary" href="#" aria-label="Add a new report">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="16"></line>
                <line x1="8" y1="12" x2="16" y2="12"></line>
              </svg>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Current month
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Last quarter
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Social engagement
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                  <polyline points="14 2 14 8 20 8"></polyline>
                  <line x1="16" y1="13" x2="8" y2="13"></line>
                  <line x1="16" y1="17" x2="8" y2="17"></line>
                  <polyline points="10 9 9 9 8 9"></polyline>
                </svg>
                Year-end sale
              </a>
            </li>
          </ul>
        </div>
      </nav>

      <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="container" style="max-width: 1200px">
          <h2 class="my-5">Заявки пользователей</h2>
          <table class="table table-striped table-md">
            <?php
            if (mysqli_num_rows($claims)) {
              echo ' 
                  <thead>
                    <tr data-aos="fade-left" >
                      <th style="min-width: 150px; ">Номер заявки</th>
                      <th style="min-width: 250px;">Название</th>
                      <th  >Текст заявки</th>
                      <th class="text-center">Действия</th>
                    </tr>
                  </thead>
                <tbody>
                ';
              while ($claim = mysqli_fetch_assoc($claims)) {
                echo '
                    <tr data-aos="fade-right">
                      <td >' . $claim["id"] . '</td>
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