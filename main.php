<?php
session_start();

if (!$_SESSION['user']) {
  header('Location: /');
}

require_once 'vendor/connect.php';
$claims = mysqli_query($connect, "SELECT * FROM `claims` ");


?>


<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="Ilya Sokol">
  <title>Business template</title>

  <link rel="icon" type="image/png" href="./images/favicon.png" />
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/fonts.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/main.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/swiper.min.css">
  <link rel="stylesheet" type="text/css" href="./assets/stylesheets/min/aos.min.css">
</head>

<body class="page">
  <div class="preloader align-items-center justify-content-center">
    <div class="spinner-border text-primary" role="status">
      <span class="d-none">Loading...</span>
    </div>
  </div>
  <header class="sticky-navbar navbar navbar-expand-lg navbar-dark primary-color w-100">
    <div class="container">
      <a class="navbar-brand" href="/">STOPяма.рф</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="#services">Главная</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#projects">База Ям</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#reviews">Поддержка</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contacts">Форум</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#contacts">О нас</a>
          </li>
          <li class="nav-item">
            <?php
            if ($_SESSION['user']['user_group'] === '0') {
              echo '
              <div class="header-dropdown btn-group">
                <a type="button" class="nav-link text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  ' . $_SESSION['user']['login'] . '
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="profile.php">Мой профиль</a>
                  <a class="dropdown-item" href="vendor/logout.php">Выйти из аккаунта</a>
              </div>
              ';
            } else if ($_SESSION['user']['user_group'] === '1') {
              echo '
              <div class="header-dropdown btn-group">
                <a type="button" class="nav-link text-white" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  ' . $_SESSION['user']['login'] . '
                </a>
                <div class="dropdown-menu">
                  <a class="dropdown-item" href="profile.php">Мой профиль</a>
                  <a class="dropdown-item" style="color:red" href="admin/content.php" target="_blank">Админ панель</a>
                  <a class="dropdown-item" href="vendor/logout.php">Выйти из аккаунта</a>
                </div>
              </div>
              ';
            }
            ?>
          </li>
        </ul>
      </div>
    </div>
  </header>
  <main id="content">
    <section id="preview" class="page-preview d-flex align-items-center justify-content-start" style="min-height: 656px; max-height: 656px; overflow: hidden;">
      <div class="container">
        <div class="preview-image__intro" data-aos="fade-right">
          <h1>Государственный проект STOPяма.рф</h1>
          <div class="subtitle">РосЯма — проект Фонда борьбы с коррупцией, созданный для тех, кто недоволен плохими дорогами и хочет это исправить.</div>
          <div class="preview-buttons">
            <button type="button" class="btn btn-light-blue btn-lg mr-2">Оставить заявку</button>
            <button type="button" class="btn btn-lg btn-outline-secondary" data-sokol>Подробнее</button>
          </div>
        </div>
      </div>
      <div class="preview-overlay-fix"></div>
    </section>
    <section class="page-section page-subpreview">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="subpreview__item" data-aos="fade-up">
              <h1>Хотите оставить обращение?</h1>
              <div class="subpreview__subtitle">Мы поможем составить обращение, отправить его в ГИБДД и проконтролировать ремонт ям.</div>
            </div>
          </div>
          <div class="col-lg-7">
            <div class="subpreview__item" data-aos="fade-up">
              <img class="thumbnail-macbook" src="./assets/images/macbook.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- PHP START -->
    <section class="page-section page-features bg-white">
      <div class="container" style="max-width: 1200px">
        <div class="page-section__header" data-aos="fade">
          <h2 class="text-center mb-4">
            Заявки на ремонт
          </h2>
          <div class="page-section__header__subtitle text-center">
            Здесь вы можете оставить заявки на ремонт
          </div>
        </div>
       
       
          

        <div class="row">
        <?php
          if (mysqli_num_rows($claims)) {
            
            while ($claim = mysqli_fetch_assoc($claims)) {

              $statusText = $claim["status"] === '1' ? 'Устранено' : 'В обработке';
              $statusClass = $claim["status"] === '1' ? 'status-open' : 'status-closed';
              $imageBeforeSrcRender = $claim["value"] === '' ? 'assets/images/noimage.png' : $claim["value"];
              $imageAfterSrcRender = $claim["newValue"] === '' ? 'assets/images/noimage.png' : $claim["newValue"];
              $renderSecondImage;

              if($claim["status"] === '1') {
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
                    ' . $renderSecondImage .'
                    
                  </div>
                  <div class="claim__item__body">
                    <div class="claim__item__body__status ' . $statusClass .'">
                    ' . $statusText .'
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
            echo '<h3 class="text-center w-100">Новых заявок нет!</h3>';
          }
          ?>
        </div>

        <div class="container" style="max-width: 700px">
          <div class="my-5">
            <h3 class="my-0">Добавить новую заявку</h3>
          </div>
          <form action="admin/includes/add-claim.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
              <input class="form-control" type="text" name="title" placeholder="Название заявки">
            </div>
            <div class="form-group" id="image-form">
              <label class="form-label" for="image">Изображение</label>
              <input class="form-control" style="height: 43px;"  name="image" id="image" type="file" accept="image/jpeg,image/png,image/gif">
            </div>
            <div class="form-group">
              <button name="submit" type="submit" class="btn btn-primary">Добавить заявку</button>
            </div>
          </form>
        </div>
      </div>
    </section>



    <section class="page-section page-reviews">
      <div class="container">
        <div class="page-section__header" data-aos="fade">
          <h2 class="text-center mb-4">
            Отызвы о STOPяма.рф
          </h2>
          <div class="page-section__header__subtitle text-center">
            Мы собрали самые популярные отзывы о нас
          </div>
        </div>
        <div class="swiper-container">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="row">

                <div class="col-lg-4 col-md-12 mb-4">
                  <div class="reviews__item" data-aos="fade-left" data-aos-duration="600">
                    <div class="reviews__item__text p-3">
                      Morbi venenatis, nulla at accumsan fermentum, risus ligula vehicula justo, a dapibus arcu purus et arcu
                      <div class="reviews__item__text__triangle"></div>
                    </div>
                    <div class="reviews__item__meta d-flex align-items-center justify-content-start">
                      <div class="reviews__item__meta__avatar mr-2"></div>
                      <div class="reviews__item__meta__name mr-2">Director Engineering,</div>
                      <div class="reviews__item__meta__signature">@Jon Doe</div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-4">
                  <div class="reviews__item" data-aos="fade-left" data-aos-duration="800">
                    <div class="reviews__item__text p-3" data-sokol>
                      Morbi venenatis, nulla at accumsan fermentum, risus ligula vehicula justo, a dapibus arcu purus et arcu
                      <div class="reviews__item__text__triangle"></div>
                    </div>
                    <div class="reviews__item__meta d-flex align-items-center justify-content-start">
                      <div class="reviews__item__meta__avatar mr-2"></div>
                      <div class="reviews__item__meta__name mr-2">Director Engineering,</div>
                      <div class="reviews__item__meta__signature">@Jon Doe</div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-4">
                  <div class="reviews__item" data-aos="fade-left" data-aos-duration="1000">
                    <div class="reviews__item__text p-3">
                      Morbi venenatis, nulla at accumsan fermentum, risus ligula vehicula justo, a dapibus arcu purus et arcu
                      <div class="reviews__item__text__triangle"></div>
                    </div>
                    <div class="reviews__item__meta d-flex align-items-center justify-content-start">
                      <div class="reviews__item__meta__avatar mr-2"></div>
                      <div class="reviews__item__meta__name mr-2">Director Engineering,</div>
                      <div class="reviews__item__meta__signature">@Jon Doe</div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="swiper-slide">
              <div class="row">

                <div class="col-lg-4 col-md-12 mb-4">
                  <div class="reviews__item">
                    <div class="reviews__item__text p-3">
                      Morbi venenatis, nulla at accumsan fermentum, risus ligula vehicula justo, a dapibus arcu purus et arcu
                      <div class="reviews__item__text__triangle"></div>
                    </div>
                    <div class="reviews__item__meta d-flex align-items-center justify-content-start">
                      <div class="reviews__item__meta__avatar mr-2"></div>
                      <div class="reviews__item__meta__name mr-2">Director Engineering,</div>
                      <div class="reviews__item__meta__signature">@Jon Doe</div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-4">
                  <div class="reviews__item">
                    <div class="reviews__item__text p-3">
                      Morbi venenatis, nulla at accumsan fermentum, risus ligula vehicula justo, a dapibus arcu purus et arcu
                      <div class="reviews__item__text__triangle"></div>
                    </div>
                    <div class="reviews__item__meta d-flex align-items-center justify-content-start">
                      <div class="reviews__item__meta__avatar mr-2"></div>
                      <div class="reviews__item__meta__name mr-2">Director Engineering,</div>
                      <div class="reviews__item__meta__signature">@Jon Doe</div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-4">
                  <div class="reviews__item">
                    <div class="reviews__item__text p-3">
                      Morbi venenatis, nulla at accumsan fermentum, risus ligula vehicula justo, a dapibus arcu purus et arcu
                      <div class="reviews__item__text__triangle"></div>
                    </div>
                    <div class="reviews__item__meta d-flex align-items-center justify-content-start">
                      <div class="reviews__item__meta__avatar mr-2"></div>
                      <div class="reviews__item__meta__name mr-2">Director Engineering,</div>
                      <div class="reviews__item__meta__signature">@Jon Doe</div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="swiper-slide">
              <div class="row">

                <div class="col-lg-4 col-md-12 mb-4">
                  <div class="reviews__item">
                    <div class="reviews__item__text p-3">
                      Morbi venenatis, nulla at accumsan fermentum, risus ligula vehicula justo, a dapibus arcu purus et arcu
                      <div class="reviews__item__text__triangle"></div>
                    </div>
                    <div class="reviews__item__meta d-flex align-items-center justify-content-start">
                      <div class="reviews__item__meta__avatar mr-2"></div>
                      <div class="reviews__item__meta__name mr-2">Director Engineering,</div>
                      <div class="reviews__item__meta__signature">@Jon Doe</div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-4">
                  <div class="reviews__item">
                    <div class="reviews__item__text p-3">
                      Morbi venenatis, nulla at accumsan fermentum, risus ligula vehicula justo, a dapibus arcu purus et arcu
                      <div class="reviews__item__text__triangle"></div>
                    </div>
                    <div class="reviews__item__meta d-flex align-items-center justify-content-start">
                      <div class="reviews__item__meta__avatar mr-2"></div>
                      <div class="reviews__item__meta__name mr-2">Director Engineering,</div>
                      <div class="reviews__item__meta__signature">@Jon Doe</div>
                    </div>
                  </div>
                </div>

                <div class="col-lg-4 col-md-12 mb-4">
                  <div class="reviews__item">
                    <div class="reviews__item__text p-3">
                      Morbi venenatis, nulla at accumsan fermentum, risus ligula vehicula justo, a dapibus arcu purus et arcu
                      <div class="reviews__item__text__triangle"></div>
                    </div>
                    <div class="reviews__item__meta d-flex align-items-center justify-content-start">
                      <div class="reviews__item__meta__avatar mr-2"></div>
                      <div class="reviews__item__meta__name mr-2">Director Engineering,</div>
                      <div class="reviews__item__meta__signature">@Jon Doe</div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>

    <section class="page-section page-resume bg-light-blue">
      <div class="container">
        <div class="page-section__header">
          <h2 class="text-center mb-4" data-aos="fade-left">
            Заинтересовались?
          </h2>
          <div class="page-section__header__subtitle text-center" data-aos="fade-right">
            В течении 24 часов мы гарантированно обработаем заявку и вышлем ответ по почте
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-center" data-aos="fade-left">
          <button type="button" class="btn btn-outline-white btn-lg mr-2">Оставить заявку</button>
        </div>
      </div>
    </section>
  </main>


  <footer class="page-footer text-lg-start">
    <div class="container p-4">
      <div class="row">
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="footer-list__title">Product</h5>
          <ul class="list-unstyled mb-0">
            <li>
              <a href="#">iPhone, iPad & Android</a>
            </li>
            <li>
              <a href="#">Widgets</a>
            </li>
            <li>
              <a href="#"> Instant answers</a>
            </li>
            <li>
              <a href="#"> Inspector</a>
            </li>
            <li>
              <a href="#"> Facebook</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="footer-list__title mb-0">Resources</h5>
          <ul class="list-unstyled">
            <li>
              <a href="#!">Success Stories</a>
            </li>
            <li>
              <a href="#!">Integration Partners</a>
            </li>
            <li>
              <a href="#!">UserCentered </a>
            </li>
            <li>
              <a href="#!"> Developer Docs </a>
            </li>
            <li>
              <a href="">Knowledge base</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="footer-list__title mb-0">Other</h5>
          <ul class="list-unstyled">
            <li>
              <a href="#">Feedback forum</a>
            </li>
            <li>
              <a href="#">System status</a>
            </li>
            <li>
              <a href="#">Security and compliance</a>
            </li>
            <li>
              <a href="#">Terms of Service</a>
            </li>
            <li>
              <a href="">Blog</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
          <h5 class="footer-list__title mb-0">Newsletter</h5>
          <p>
            Subscribe to our newsletter! Get productivity tips,
            product updates and special offers!
          </p>
          <div class="mb-2">
            <input type="email" placeholder="Your e-mail address">
          </div>
          <div>
            <button type="button" class="btn btn-secondary">Subscribe</button>
          </div>
        </div>
      </div>
      <div class="footer-line"></div>
      <div class="text-start mb-3">
        © 2020 Copyright:
        <a class="text-white" href="https://github.com/lezvieprod">Ilya Sokol</a>
      </div>
      <div class="text-white display-7" style="font-size: 14px;">
        Designed by
        <a class="" href="https://github.com/lezvieprod">Ilya Sokol</a>
      </div>
    </div>
  </footer>

  <div class="scroll-up">
    <a href="#preview">
      <svg width="17" height="17">
        <use xlink:href="#arrowTop"></use>
      </svg>
    </a>
  </div>

  <script src="./assets/js/min/jquery.min.js"></script>
  <script src="./assets/js/min/popper.min.js"></script>
  <script src="./assets/js/min/bootstrap.min.js"></script>

  <script src="./assets/js/min/aos.min.js"></script>
  <script src="./assets/js/min/swiper-bundle.min.js"></script>
  <script src="./assets/js/all.js"></script>

  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="display: none;">
    <defs>
      <symbol id="sale" viewBox="0 0 512.001 512.001">
        <polygon points="216.644,239.695 207.716,269.451 225.165,269.451 		" />
        <path d="M489.273,256L512,215.454l-34.145-31.539l9.087-45.586l-42.22-19.444l-5.445-46.162l-46.162-5.445l-19.444-42.22
              l-45.585,9.086L296.547,0L256,22.727L215.454,0l-31.538,34.145l-45.585-9.086l-19.444,42.22l-46.162,5.445l-5.445,46.162
              L25.059,138.33l9.087,45.586L0,215.454L22.728,256L0,296.546l34.145,31.539l-9.087,45.586l42.22,19.444l5.445,46.162l46.162,5.445
              l19.444,42.22l45.585-9.087l31.538,34.145l40.546-22.727l40.546,22.727l31.538-34.145l45.585,9.087l19.444-42.22l46.162-5.445
              l5.445-46.162l42.22-19.444l-9.087-45.586l34.145-31.539L489.273,256z M167.344,291.024c-2.119,3.922-4.915,7.057-8.385,9.4
              c-3.473,2.345-7.396,4.036-11.768,5.072c-4.374,1.036-8.77,1.556-13.188,1.556c-3.517,0-7.124-0.271-10.819-0.811
              c-3.698-0.541-7.371-1.307-11.024-2.299c-3.652-0.991-7.169-2.164-10.55-3.517c-3.381-1.353-6.515-2.884-9.4-4.599l11.361-23.129
              c3.155,1.984,6.445,3.743,9.873,5.275c2.885,1.353,6.154,2.569,9.806,3.652c3.652,1.082,7.372,1.623,11.159,1.623
              c2.884,0,4.89-0.382,6.019-1.15c1.127-0.765,1.69-1.779,1.69-3.044c0-1.353-0.564-2.502-1.69-3.449
              c-1.129-0.947-2.684-1.78-4.666-2.502c-1.984-0.72-4.261-1.441-6.83-2.164c-2.569-0.72-5.298-1.577-8.183-2.569
              c-4.239-1.441-7.891-2.997-10.956-4.666c-3.066-1.668-5.592-3.561-7.574-5.681c-1.984-2.117-3.449-4.531-4.396-7.236
              c-0.946-2.705-1.42-5.816-1.42-9.333c0-5.32,0.968-10.009,2.907-14.066c1.939-4.057,4.575-7.439,7.912-10.144
              c3.335-2.705,7.146-4.754,11.43-6.154c4.281-1.397,8.812-2.096,13.593-2.096c3.517,0,6.943,0.338,10.278,1.015
              c3.336,0.676,6.56,1.535,9.671,2.569c3.111,1.038,6.019,2.164,8.724,3.382c2.705,1.218,5.14,2.367,7.304,3.449l-11.361,21.776
              c-2.705-1.623-5.501-3.065-8.386-4.328c-2.434-1.083-5.163-2.097-8.183-3.044c-3.022-0.946-5.974-1.421-8.858-1.421
              c-2.346,0-4.216,0.361-5.613,1.083c-1.398,0.723-2.096,1.94-2.096,3.652c0,1.264,0.405,2.299,1.218,3.111
              c0.811,0.811,1.981,1.556,3.517,2.231c1.532,0.676,3.402,1.332,5.613,1.961c2.208,0.631,4.71,1.399,7.506,2.299
              c4.417,1.353,8.407,2.84,11.97,4.463c3.562,1.623,6.605,3.54,9.131,5.748c2.522,2.21,4.463,4.893,5.816,8.047
              c1.353,3.158,2.028,6.989,2.028,11.497C170.522,282.255,169.462,287.102,167.344,291.024z M235.173,305.834l-5.816-18.799h-25.563
              l-5.681,18.799h-26.916l33.408-96.029h24.075l33.273,96.029H235.173z M269.932,305.834v-96.029h26.374v73.037h43.551v22.993
              H269.932z M417.494,305.834h-0.001h-68.438v-96.029h67.222v22.994H375.43v13.525h34.896v21.37H375.43v15.149h42.064V305.834z" />

      </symbol>
      <symbol id="telegram" viewBox="0 0 24 24">
        <path d="m9.417 15.181-.397 5.584c.568 0 .814-.244 1.109-.537l2.663-2.545 5.518 4.041c1.012.564 1.725.267 1.998-.931l3.622-16.972.001-.001c.321-1.496-.541-2.081-1.527-1.714l-21.29 8.151c-1.453.564-1.431 1.374-.247 1.741l5.443 1.693 12.643-7.911c.595-.394 1.136-.176.691.218z" />
      </symbol>
      <symbol id="badge" viewBox="0 0 24 24">
        <path d="m12 0c-3.86 0-7 3.14-7 7s3.14 7 7 7 7-3.14 7-7-3.14-7-7-7zm3.787 6.757-1.361 1.395.323 1.978c.046.283-.073.568-.309.734-.128.09-.28.136-.431.136-.125 0-.25-.031-.363-.094l-1.646-.909-1.646.91c-.251.139-.561.123-.795-.043-.235-.166-.354-.451-.309-.734l.323-1.978-1.36-1.395c-.196-.201-.264-.496-.174-.762.089-.267.319-.46.598-.503l1.851-.283.834-1.777c.246-.527 1.111-.527 1.357 0l.834 1.777 1.851.283c.278.042.509.236.598.503.089.266.021.561-.175.762z" />
        <path d="m5.96 12.98-3.87 6.95c-.13.24-.12.54.03.77s.41.37.69.34l3.08-.23 1.36 2.77c.13.25.38.41.65.42h.02c.27 0 .53-.15.66-.38l2.52-4.48-2.45-4.33c-1.01-.43-1.92-1.06-2.69-1.83z" />
        <path d="m21.9 19.93-3.9-6.91c-1.27 1.27-2.94 2.13-4.8 2.39-.39.06-.79.09-1.2.09-.44 0-.87-.03-1.29-.1l1.25 2.21 3.39 6.01c.13.23.38.38.65.38h.02c.28-.01.53-.17.66-.42l1.37-2.77 3.14.24c.28.02.54-.11.69-.35.15-.23.16-.53.02-.77z" />
      </symbol>
      <symbol id="heart" viewBox="0 0 512 512">
        <path d="M376,30c-27.783,0-53.255,8.804-75.707,26.168c-21.525,16.647-35.856,37.85-44.293,53.268
        c-8.437-15.419-22.768-36.621-44.293-53.268C189.255,38.804,163.783,30,136,30C58.468,30,0,93.417,0,177.514
        c0,90.854,72.943,153.015,183.369,247.118c18.752,15.981,40.007,34.095,62.099,53.414C248.38,480.596,252.12,482,256,482
        s7.62-1.404,10.532-3.953c22.094-19.322,43.348-37.435,62.111-53.425C439.057,330.529,512,268.368,512,177.514
        C512,93.417,453.532,30,376,30z" />
      </symbol>
      <symbol id="arrowTop" viewBox="-21 0 512 512">
        <path d="m352 234.667969c0 11.730469-9.601562 21.332031-21.332031 21.332031-3.203125 0-6.1875-.640625-8.960938-1.921875l-87.039062-40.746094-87.042969 40.746094c-2.773438 1.28125-5.757812 1.921875-8.957031 1.921875-11.734375 0-21.335938-9.601562-21.335938-21.332031 0-3.203125.640625-5.976563 1.921875-8.746094l96-213.335937c3.199219-7.464844 10.667969-12.585938 19.414063-12.585938 8.746093 0 16.210937 5.121094 19.410156 12.585938l96 213.335937c1.28125 2.769531 1.921875 5.542969 1.921875 8.746094zm0 0" />
        <path d="m234.667969 512c-129.386719 0-234.667969-105.28125-234.667969-234.667969 0-71.144531 31.660156-137.46875 86.890625-181.949219 9.195313-7.425781 22.613281-5.933593 29.996094 3.21875 7.378906 9.175782 5.929687 22.613282-3.242188 29.996094-45.101562 36.351563-70.976562 90.539063-70.976562 148.734375 0 105.855469 86.121093 192 192 192 105.875 0 192-86.144531 192-192 0-58.195312-25.878907-112.382812-70.976563-148.714843-9.195312-7.378907-10.625-20.820313-3.242187-29.992188 7.421875-9.152344 20.839843-10.644531 29.992187-3.222656 55.234375 44.460937 86.890625 110.785156 86.890625 181.929687 0 129.386719-105.277343 234.667969-234.664062 234.667969zm0 0" />
      </symbol>
    </defs>
  </svg>

</body>

</html>