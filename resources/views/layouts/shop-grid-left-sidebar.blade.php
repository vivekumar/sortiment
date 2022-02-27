
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
      @include('layouts.include.head')
      @yield('style')
   </head>
   <body>
      @include('layouts.include.loginModel')
      @include('layouts.include.navbarTop')
      @include('layouts.include.navbar')      
      <section class="products_page">
         <div class="container">
            <div class="row">
               <div class="col-lg-3 col-md-4">
                  <div class="widget">
                     <div class="category_sidebar">
                     @section('sidebar')
                        @include('layouts.partials.sidebar')
                     @show                  
                     </div>
                  </div>
                  <hr>
                  <a href="shop-grid-left-sidebar.html">
                  <img class="rounded" src="https://askbootstrap.com/preview/osahan-fashion/images/women-top.png" alt="Bannar 1">
                  </a>
               </div>
               <div class="col-lg-9 col-md-8">
                  @include('layouts.partials.innerSlider')
                  @include('layouts.partials.productsTopFilter')
                  @if(session()->has('massage'))
                     <p class="alert alert-success">  {{ session()->get('massage') }}
                     </p>
                  @endif            
                  @include('layouts.partials.productItem')                  
                  @yield('content')
                  @include('layouts.partials.pagination')
               </div>
            </div>
         </div>
      </section>
      @include('layouts.partials.topBrands')
      @include('layouts.include.footer')
      @yield('script')
   </body>
</html>


