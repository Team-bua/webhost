<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('dashboard/assets/img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('dashboard/assets/img/favicon.png') }}">
  <title>
    Trang đăng nhập
  </title>
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
</head>

<body class="">
  {{-- <div class="container position-sticky z-index-sticky top-0">
    <div class="row">
      <div class="col-12">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
          <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navigation">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="nav-link d-flex align-items-center me-2 active" aria-current="page" href="{{ route('index') }}">
                    Trang chủ
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{ route('card') }}">
                    Mua thẻ
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="#">
                    Hướng dẫn
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{ route('about') }}">
                    Về chúng tôi
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link me-2" href="{{ route('contact') }}">
                    Liên hệ
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <!-- End Navbar -->
      </div>
    </div>
  </div> --}}
  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Data Hosting</h3>
                  <p class="mb-0">Nhập email và mật khẩu của bạn để đăng nhập</p>
                </div>
                <div class="card-body">
                    <form role="form" action="{{ route('signin') }}" method="post">
                      @csrf
                    <label>Email</label>
                    <div class="mb-3">
                      <input type="email" name="email" class="form-control" placeholder="Email" aria-label="Email" aria-describedby="email-addon">
                      @error('email')
                        <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
                      @enderror
                    </div>
                    <label>Mật khẩu</label>
                    <div class="mb-3">
                      <input type="password" name="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password-addon">
                      @error('password')
                        <p style="color:red; font-size: 13px; margin-left: 10px">{{ $message }}</p>
                      @enderror
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" type="checkbox" name="rememberMe" id="rememberMe">
                      <label class="form-check-label" for="rememberMe">Nhớ mật khẩu</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Đăng nhập</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('dashboard/assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script src="{{ asset('dashboard/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
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
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('dashboard/assets/js/plugins/jquery.min.js') }}" type="text/javascript"></script>
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('dashboard/assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
  <script type="text/javascript">
  function update(){
    Swal.fire({
        title: 'Tính năng đang cập nhật!',
        showConfirmButton: true,
        timer: 2000
    })
  }
    $(document).ready(function () {
      var msg = "{{Session::get('message')}}";
      var exist = "{{Session::has('message')}}";
      console.log(msg, exist);
      if (exist && msg == '2') {
        Swal.fire({
              icon: 'success',
              title: 'Đăng nhập thành công!',
              showConfirmButton: false,
              timer: 2500
          })
        }else if(exist && msg == '3') {
          Swal.fire({
              icon: 'error',
              title: 'Tài khoản không chính xác',
              showConfirmButton: false,
              timer: 2500
          })
        }else if(exist && msg == '4') {
            Swal.fire({
                icon: 'error',
                title: 'Tài khoản của bạn đã bị khóa!',
                showConfirmButton: false,
                timer: 2500
            })
        }
    })
  </script>
</body>

</html>