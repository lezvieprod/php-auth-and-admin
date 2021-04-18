$(document).ready(function () {

  // aos init
  AOS.init({
    // Global settings:
    disable: false, // accepts following values: 'phone', 'tablet', 'mobile', boolean, expression or function
    startEvent: 'DOMContentLoaded', // name of the event dispatched on the document, that AOS should initialize on
    initClassName: 'aos-init', // class applied after initialization
    animatedClassName: 'aos-animate', // class applied on animation
    useClassNames: false, // if true, will add content of `data-aos` as classes on scroll
    disableMutationObserver: false, // disables automatic mutations' detections (advanced)
    debounceDelay: 50, // the delay on debounce used while resizing window (advanced)
    throttleDelay: 22, // the delay on throttle used while scrolling the page (advanced)
    // Settings that can be overridden on per-element basis, by `data-aos-*` attributes:
    offset: 20, // offset (in px) from the original trigger point
    delay: 0, // values from 0 to 3000, with step 50ms
    duration: 600, // values from 0 to 3000, with step 50ms
    easing: 'ease-in-out', // default easing for AOS animations
    once: true, // whether animation should happen only once - while scrolling down
    mirror: false, // whether elements should animate out while scrolling past them
    anchorPlacement: 'top-bottom', // defines which position of the element regarding to window should trigger the animation
  });

  // navbar fix color 
  const navbarToggler = document.querySelector('.navbar-toggler');
  const pageHeader = document.querySelector('.sticky-navbar');
  const navbarToggleMenu = document.querySelector('.navbar-collapse');
  navbarToggler.addEventListener('click', function () {
    setTimeout(function () {
      if (navbarToggleMenu.classList.contains('show')) {
        pageHeader.classList.add('sticky-navbar--collapsed');
      } else {
        pageHeader.classList.remove('sticky-navbar--collapsed');
      }
    }, 400);
  });

  // smooth scrool to top
  $(window).scroll(function () {
    if ($(this).scrollTop() > 100) {
      $('.scroll-up').fadeIn();
    } else {
      $('.scroll-up').fadeOut();
    }
  });

  // swiper init
  let swiper = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 10,
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
  });


  /*
    Авторизация
 */

  $('.login-btn').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('error');

    let login = $('input[name="login"]').val(),
      password = $('input[name="password"]').val();

    $.ajax({
      url: 'vendor/signin.php',
      type: 'POST',
      dataType: 'json',
      data: {
        login: login,
        password: password
      },
      success(data) {

        if (data.status) {
          document.location.href = '/main.php';
        } else {

          if (data.type === 1) {
            data.fields.forEach(function (field) {
              $(`input[name="${field}"]`).addClass('error');
            });
          }

          $('.msg').removeClass('none').text(data.message);
        }

      }
    });

  });

  /*
    Получение аватарки с поля
  */

  let avatar = false;

  $('input[name="avatar"]').change(function (e) {
    avatar = e.target.files[0];
  });

  /*
    Регистрация
  */

  $('.register-btn').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('error');

    let login = $('input[name="login"]').val(),
      password = $('input[name="password"]').val(),
      full_name = $('input[name="full_name"]').val(),
      email = $('input[name="email"]').val(),
      password_confirm = $('input[name="password_confirm"]').val();

    let formData = new FormData();
    formData.append('login', login);
    formData.append('password', password);
    formData.append('password_confirm', password_confirm);
    formData.append('full_name', full_name);
    formData.append('email', email);
    formData.append('avatar', avatar);

    console.log('test');

    $.ajax({
      url: 'vendor/signup.php',
      type: 'POST',
      dataType: 'json',
      processData: false,
      contentType: false,
      cache: false,
      data: formData,
      success(data) {

        if (data.status) {
          document.location.href = '/index.php';
        } else {

          if (data.type === 1) {
            data.fields.forEach(function (field) {
              $(`input[name="${field}"]`).addClass('error');
            });
          }

          $('.msg').removeClass('none').text(data.message);

        }

      }
    });

  });

});
