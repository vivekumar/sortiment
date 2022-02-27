<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sortiment B2B - Order Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{asset('frontend/assets/css/snackbar.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">
</head>
<body>
    <div id="main-wrapper">
        @include('employee.body.header')
        <div class="content-wrap">
            <section class="product-sec d-flex align-items-start justify-content-end">
                @include('employee.body.sidebar')
                <div class="products-con">
                    @yield('content')
                </div><!-- Product container -->
            </section><!-- Product section -->
        </div><!-- Content wrapper -->
    </div><!-- Main wrapper -->

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="{{asset('frontend/assets/js/custom.js')}}"></script>
    @yield('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script>
  @if(Session::has('message'))
    var type="{{ Session::get('alert-type','info')}}"
    switch(type){
      case 'info':
      toastr.info(" {{ Session::get('message')}} ");
      break;

      case 'success':
      toastr.success(" {{ Session::get('message')}} ");
      break;

      case 'warning':
      toastr.warning(" {{ Session::get('message')}} ");
      break;

      case 'error':
      toastr.error(" {{ Session::get('message')}} ");
      break;
    }
  @endif
  </script>
</body>
</html>
