<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{{ csrf_token() }}}"/>
    <title>
        @if(isset($seo['metaTitle']) && !empty($seo['metaTitle'])) 
            {{$seo['metaTitle']}}
        @else 
            {{ config('app.name', 'Sortiment') }}
        @endif
    </title>
    <meta name="description" content="
        @if(isset($seo['metaDescription']) && !empty($seo['metaDescription'])) 
            {{$seo['metaDescription']}}        
        @endif
    ">
    <meta name="keywords" content="
        @if(isset($seo['metaTag']) && !empty($seo['metaTag'])) 
            {{$seo['metaTag']}}        
        @endif
    ">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <!-- Main CSS -->
    @yield('css')
    <link rel="stylesheet" href="{{asset('frontend/assets/css/snackbar.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/assets/css/responsive.css')}}">
    <script type="text/javascript">
        window.base_url = "{{ url('/') }}";
  </script>
</head>
<body>
    <div id="main-wrapper">
        @include('company.body.header')
        <div class="content-wrap">
            <section class="product-sec d-flex align-items-start justify-content-end">
                @include('company.body.sidebar')
                <div class="products-con">
                    @yield('content')
                </div><!-- Product container -->
            </section><!-- Product section -->
        </div><!-- Content wrapper -->
    </div><!-- Main wrapper -->

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{asset('frontend/assets/js/custom.js')}}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="{{asset('frontend/assets/js/snackbar.js')}}"></script>
    
    @yield('js')
</body>
</html>
