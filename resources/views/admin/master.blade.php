<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('dashboard/assets/img/fav-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('dashboard/assets/img/fav-icon.png') }}">
  <title>Trang quản lý Admin</title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('dashboard/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('dashboard/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="{{ asset('dashboard/assets/js/plugins/42d5adcbca.js') }}" crossorigin="anonymous"></script>
  <link href="{{ asset('dashboard/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('dashboard/assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('dashboard/assets/css/soft-ui-dashboard2.min.css?v=1.0.0') }}">
</head>

<body class="g-sidenav-show  bg-gray-100">
  @include('admin.slidebar')
  @yield('content')
  <!--   Core JS Files   -->
  <script src="{{ asset('dashboard/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/chartjs.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/jquery.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/jquery.validate.min.js') }}" type="text/javascript"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/flatpickr.min.js') }}" type="text/javascript"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('dashboard/assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
  <script>
    function changeImg(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          $('#img').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
    $('#img').click(function() {
      $('#fImages').click();
    });

    function changeThumbnail(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#thum').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $('#thum').click(function() {
        $('#thumbnail').click();
    });

    $("div.alert").delay(3000).slideUp();
  </script>
  <script type="text/javascript">
    $(document).ready(function () {
      var msg = "{{Session::get('message')}}";
      var exist = "{{Session::has('message')}}";
      console.log(msg, exist);
        if(exist && msg == '2') {
          Swal.fire({
              icon: 'success',
              title: 'Đăng nhập thành công!',
              showConfirmButton: false,
              timer: 2000
          })
        }
        else if(exist && msg == '3') {
          Swal.fire({
              icon: 'error',
              title: 'Tài khoản không chính xác',
              showConfirmButton: false,
              timer: 2000
          })
        }
    })
  </script>
  @yield('script')
</body>

</html>