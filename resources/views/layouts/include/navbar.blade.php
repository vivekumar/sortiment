<nav class="navbar navbar-light navbar-expand-lg bg-primary bg-faded osahan-menu osahan-menu-top-2">
   <div class="container">
      <a class="navbar-brand" href=""> <img src="{{ asset('frontend/images/logo.png') }}" alt="logo"> {{-- config('app.name', 'Laravel') --}}</a>
      <button class="navbar-toggler navbar-toggler-white" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-collapse" id="navbarNavDropdown">
         <div class="navbar-nav mr-auto mt-2 mt-lg-0 margin-auto top-categories-search-main">
            <div class="top-categories-search">
               <div class="input-group">
                  <span class="input-group-btn categories-dropdown">
                     <select class="form-control">
                        <option selected="selected">All Categories</option>
                        <optgroup label="Men's">
                           <option value="0">Footwear</option>
                           <option value="2">Bags & Luggage</option>
                           <option value="3">Clothing</option>
                           <option value="4">Watches</option>
                        </optgroup>
                        <optgroup label="Women's">
                           <option value="5">Fashion Jewellery </option>
                           <option value="6">Bags & Luggage </option>
                           <option value="4">Watches</option>
                        </optgroup>
                     </select>
                  </span>
                  <input class="form-control" placeholder="Search products & brands" aria-label="Search products & brands" type="text">
                  <span class="input-group-btn">
                  <button class="btn btn-warning" type="button"><i class="icofont icofont-search-alt-2"></i> Search</button>
                  </span>
               </div>
            </div>
         </div>
         <div class="my-2 my-lg-0">
            <ul class="list-inline main-nav-right">
               <li class="list-inline-item dropdown osahan-top-dropdown">
                  <a class="btn btn-outline-light dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icofont icofont-shopping-cart"></i> Cart 
                     @if (Session::has('cart')) 
                        <small class="cart-value">{{ session('cart')->getTotalQty() }}</small>
                     @endif
                  
                  </a>
                  <div class="dropdown-menu dropdown-menu-right cart-dropdown">
                     @if (Session::has('cart'))                        
                        @php
                           $products=session('cart')->getContents();
                                                  
                        @endphp
                        {{-- print_r(session('cart')->getContents()) --}}
                        @foreach($products as $product)
                           @php
                              $images = explode('|',$product['product']->thumbnail);
                           @endphp                             
                              <div class="dropdown-item">                      
                                 <a class="pull-right" data-toggle="tooltip" data-placement="top" title="" href="#" data-original-title="Remove">
                                 <i class="fa fa-trash-o"></i>
                                 </a>
                                 <a href="#">
                                 <img class="img-fluid" src="{{ asset('/image/'.$images[0])}}" alt="Product">
                                 <strong>{{$product['product']->name}}</strong>
                                 <small>Color : Red | Size : M</small>
                                 <span class="product-desc-price">${{$product['product']->price}}</span>
                                 <span class="product-price text-danger">$329.99 {{$product['product']->name}}</span>
                                 </a>
                              </div>
                        @endforeach    
                     <div class="dropdown-divider"></div>
                     <div class="dropdown-cart-footer text-center">
                        <h4> <strong>Subtotal</strong>: ${{session('cart')->getTotalPrice()}} </h4>
                        <a class="btn btn-sm btn-danger" href="{{ route('cart.all')}}"> <i class="icofont icofont-shopping-cart"></i> VIEW
                        CART </a> <a href="{{route('checkout.index')}}" class="btn btn-sm btn-primary"> CHECKOUT </a>
                     </div>
                     @else
                         no product
                     @endif
                  </div>
               </li>
             <!-- Authentication Links -->
             @guest
               <li class="list-inline-item">
                  <a  class="btn btn-theme-round" data-toggle="modal" data-target="#bd-example-modal" href="#"><i class="icofont icofont-ui-user"></i> Sign In</a>
               </li>
                 
             @else
               <li class="list-inline-item dropdown osahan-top-dropdown">
                  <a class="btn btn-outline-light dropdown-toggle dropdown-toggle dropdown-toggle-top-user" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <img src="https://askbootstrap.com/preview/osahan-fashion/images/user-ava.jpg"> <strong>Hi</strong> {{ Auth::user()->name }}
                  </a>                 

                  <div class="dropdown-menu dropdown-menu-right dropdown-list-design">
                     <a class="dropdown-item" href=""><i class="icofont icofont-ui-user"></i> My Profile</a>
                     <a class="dropdown-item" href=""><i class="icofont icofont-location-pin"></i> My Address</a>
                     <a class="dropdown-item" href=""><i class="icofont icofont-heart-alt"></i> Wish List <span class="badge badge-success">6</span></a>
                     <a class="dropdown-item" href=""><i class="icofont icofont-list"></i> Order List</a>
                     <a class="dropdown-item" href=""><i class="icofont icofont-truck-loaded"></i> Order Status</a>
                     <a class="dropdown-item" href=""><i class="icofont icofont-paper"></i> Invoice A4</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                          document.getElementById('logout-form').submit();"><i class="icofont icofont-logout"></i> Logout</a>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                     </form>
                  </div>
               </li>                 
             @endguest
            </ul>
         </div>
      </div>
   </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light osahan-menu osahan-menu-2 pad-none-mobile">
   <div class="container">
      
      <div class="collapse navbar-collapse" id="navbarText">
         <ul class="navbar-nav mt-2 mt-lg-0 margin-auto">
            <li class="nav-item dropdown active">
               <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="icofont icofont-ui-home"></i> Home <span class="sr-only">(current)</span>
               </a>
               <div class="dropdown-menu">
                  <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-fashion/index.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Home Version 1 </a>
                  <a class="dropdown-item" href="index2.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Home Version 2 </a>
                  <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-fashion/index3.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Home Version 3 </a>
                  <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-fashion/index4.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Home Version 4 </a>
                  <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-fashion/index5.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Home Version 5 </a>
               </div>
            </li>
            <li class="nav-item dropdown mega-dropdown-main">
               <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Men
               </a>
               <div class="dropdown-menu mega-dropdown">
                  <div class="row">
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list">
                           <a class="mega-title" href="#">Clothing <span class="badge badge-danger">HOT</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Casual shirt</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Trousers</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Suits & Blazers <span class="badge badge-warning">20%</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Sportswear </a>
                           <a class="mega-title" href="#">Eyewear </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Backpacks</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Ray-Ban <span class="badge badge-info">NEW</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Opium </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Joe Black </a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list">
                           <a class="mega-title" href="#">Jewellery <span class="badge badge-secondary">50%</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Gold</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Platinum</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Rings </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Neckwear </a>
                           <a class="mega-title" href="#">Watches <span class="badge badge-primary">25% OFF</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Fastrack </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Timex </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Citizen</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Titan <span class="badge badge-light">60%</span></a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list">
                           <a class="mega-title" href="#">Shoes <span class="badge badge-success">SALE</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Sports & Outdoor</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Mocassins</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Sneakers </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Formal Shoes </a>
                           <a class="mega-title" href="#">Accessories </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Handbags <span class="badge badge-dark">NEW</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Sunglasses</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Clutches </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Backpacks </a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3 mega-dropdown-ads">
                        <span class="mega-menu-img hidden-sm"> <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html"><img src="https://askbootstrap.com/preview/osahan-fashion/images/offers/men-top.png" alt="Bannar 1"></a> </span>
                     </div>
                  </div>
               </div>
            </li>
            <li class="sale-nav nav-item dropdown mega-dropdown-main">
               <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Women
               </a>
               <div class="dropdown-menu mega-dropdown">
                  <div class="row">
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3 mega-dropdown-ads">
                        <span class="mega-menu-img hidden-sm"> <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html"><img src="https://askbootstrap.com/preview/osahan-fashion/images/offers/women-top.png" alt="Bannar 1"></a> </span>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list">
                           <a class="mega-title" href="#">Eyewear <span class="badge badge-primary">NEW</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Backpacks</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Ray-Ban</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Opium <span class="badge badge-secondary">20%</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Joe Black </a>
                           <a class="mega-title" href="#">Clothing <span class="badge badge-success">SALE</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Casual shirt</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Trousers</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Suits & Blazers </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Sportswear </a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list">
                           <a class="mega-title" href="#">Watches <span class="badge badge-default">HOT</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Fastrack </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Timex </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Citizen <span class="badge badge-success">5%</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Titan </a>
                           <a class="mega-title" href="#">Jewellery </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Gold</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Platinum</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Rings </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Neckwear <span class="badge badge-light">25%</span> </a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list">
                           <a class="mega-title" href="#">Shoes  <span class="badge badge-danger">60%</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Sports & Outdoor</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Mocassins</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Sneakers <span class="badge badge-dark">10%</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Formal Shoes </a>
                           <a class="mega-title" href="#">Accessories <span class="badge badge-warning">50% OFF</span> </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Handbags</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Sunglasses</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Clutches </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Backpacks <span class="badge badge-info">HOT</span></a>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
            <li class="nav-item dropdown mega-dropdown-main">
               <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Kids
               </a>
               <div class="dropdown-menu mega-dropdown">
                  <div class="row">
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list"><a class="mega-title" href="#">Baby clothing <span class="badge badge-info">10% OFF</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Casual shirt</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Trousers</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Suits & Blazers </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Sportswear </a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list"><a class="mega-title" href="#">Boys <span class="badge badge-danger">HOT</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Clothing</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Shoes</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Watches <span class="badge badge-primary">5% OFF</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Sunglasses </a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list">
                           <a class="mega-title" href="#">Girls </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Baby Girl <span class="badge badge-dark">10%</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Shoes <span class="badge badge-warning">NEW</span></a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Watches </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Sunglasses </a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3 mega-dropdown-ads">
                        <span class="mega-menu-img hidden-sm"> <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html"><img src="https://askbootstrap.com/preview/osahan-fashion/images/offers/kids-top.png" alt="Bannar 1"></a> </span>
                     </div>
                  </div>
               </div>
            </li>
            <li class="nav-item dropdown mega-dropdown-main">
               <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Pages
               </a>
               <div class="dropdown-menu mega-dropdown">
                  <div class="row">
                     <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                        <div class="mega-list"><a class="mega-title" href="#">Shop Pages </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-full.html">Shop Grid Full width </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-right-sidebar.html">Shop Grid Right Sidebar</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-grid-left-sidebar.html">Shop Grid Left Sidebar</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-list-full.html">Shop List Full width </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-list-right-sidebar.html">Shop List Right Sidebar</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-list-left-sidebar.html">Shop List Left Sidebar</a>
                        </div>
                     </div>
                     <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                        <div class="mega-list"><a class="mega-title" href="#">Product Pages </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/category.html">Category Page</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shop-detail.html">Shop Detail</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/wishlist.html">Wishlists </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/wishlist-user.html">My Wishlist </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/compare.html">Compare </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/quick_view.html">Quick View </a>
                        </div>
                     </div>
                     <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                        <div class="mega-list"><a class="mega-title" href="#">Cart Pages </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/view-cart.html">Cart </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/cart_order.html">Cart Order</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/cart_checkout.html">Cart Checkout</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/cart_delivery.html">Cart Delivery</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/cart_done.html">Thanks for order</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/shopping_cart.html">Shopping Cart Tabs</a>
                        </div>
                     </div>
                     <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                        <div class="mega-list"><a class="mega-title" href="#">Account Pages </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/my-profile.html">My Profile</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/my-address.html">My Address</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/order-list.html">Order List</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/order-status.html">Order Status</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/invoice.html">Invoice A4</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/about.html">About Us </a>
                        </div>
                     </div>
                     <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                        <div class="mega-list"><a class="mega-title" href="#">Static Pages </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/faq.html">FAQ </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/login.html">Login</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/register.html">Register</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/login.html">Login Modal</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/terms-conditions.html">Terms and Conditions </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/privacy-policy.html">Privacy Policy</a>
                        </div>
                     </div>
                     <div class="col-lg-2 col-sm-2 col-xs-2 col-md-2">
                        <div class="mega-list"><a class="mega-title" href="#">Other Pages </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/blog-right.html">Blog &ndash; Right Sidebar </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/blog-left.html">Blog &ndash; Left Sidebar </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/blog.html">Blog &ndash; Full-Width </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/blog-single.html">Single post </a> 
                           <a href="https://askbootstrap.com/preview/osahan-fashion/email-template.html">Email Template </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/404.html">Error 404 </a>
                        </div>
                     </div>
                  </div>
                  <div class="row services-block">
                     <div class="col-xl-3 col-lg-6 d-flex">
                        <div class="item d-flex align-items-center">
                           <div class="icon"><i class="icofont icofont-free-delivery text-primary"></i></div>
                           <div class="text"><span class="text-uppercase">Free shipping &amp; return</span><small>Free Shipping over $300</small></div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-lg-6 d-flex">
                        <div class="item d-flex align-items-center">
                           <div class="icon"><i class="icofont icofont-money-bag text-primary"></i></div>
                           <div class="text"><span class="text-uppercase">Money back guarantee</span><small>30 Days Money Back</small></div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-lg-6 d-flex">
                        <div class="item d-flex align-items-center">
                           <div class="icon"><i class="icofont icofont-headphone-alt-2 text-primary"></i></div>
                           <div class="text"><span class="text-uppercase">020-800-456-747</span><small>24/7 Available Support</small></div>
                        </div>
                     </div>
                     <div class="col-xl-3 col-lg-6 d-flex">
                        <div class="item d-flex align-items-center">
                           <div class="icon"><i class="icofont icofont-shield text-primary"></i></div>
                           <div class="text"><span class="text-uppercase">Secure Payment</span><small>Secure Payment</small></div>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
            <li class="nav-item dropdown mega-dropdown-main">
               <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Components
               </a>
               <div class="dropdown-menu mega-dropdown mega-list-arrow-none">
                  <div class="row">
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list">
                           <a class="mega-title" href="#">A - C </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/alerts.html"><i class="icofont icofont-exclamation-tringle"></i> Alerts</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/badge.html"><i class="icofont icofont-file-alt"></i> Badge</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/breadcrumb.html"><i class="icofont icofont-all-caps"></i> Breadcrumb</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/button-group.html"><i class="icofont icofont-ui-social-link"></i> Button Group</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/buttons.html"><i class="icofont icofont-link-alt"></i> Buttons</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/card.html"><i class="icofont icofont-ui-v-card"></i> Card</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/carousel.html"><i class="icofont icofont-image"></i> Carousel</a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list">
                           <a class="mega-title" href="#">A - I </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/collapse.html"><i class="icofont icofont-listing-box"></i> Collapse</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/dropdowns.html"><i class="icofont icofont-line-block-down"></i> Dropdowns</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/figures.html"><i class="icofont icofont-paper"></i> Figures</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/forms.html"><i class="icofont icofont-ui-edit"></i> Forms</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/grid-system.html"><i class="icofont icofont-calculations"></i> Grid System</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/images.html"><i class="icofont icofont-ui-image"></i> Images</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/input-group.html"><i class="icofont icofont-paperclip"></i> Input Group</a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list">
                           <a class="mega-title" href="#">J - P </a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/jumbotron.html"><i class="icofont icofont-page"></i> Jumbotron</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/list-group.html"><i class="icofont icofont-list"></i> List Group</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/media-object.html"><i class="icofont icofont-multimedia"></i> Media Object</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/modal.html"><i class="icofont icofont-picture"></i> Modal</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/nav.html"><i class="icofont icofont-square"></i> Nav</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/navbar.html"><i class="icofont icofont-navigation-menu"></i> Navbar</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/pagination.html"><i class="icofont icofont-bubble-right"></i> Pagination</a>
                        </div>
                     </div>
                     <div class="col-lg-3 col-sm-3 col-xs-3 col-md-3">
                        <div class="mega-list">
                           <a class="mega-title" href="#">P - T</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/popovers.html"><i class="icofont icofont-scroll-right"></i> Popovers</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/progress.html"><i class="icofont icofont-circle-ruler"></i> Progress</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/blank-page.html"><i class="icofont icofont-paper"></i> Page Blank</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/scrollspy.html"><i class="icofont icofont-hand-drag1"></i> Scrollspy</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/tables.html"><i class="icofont icofont-table"></i> Tables</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/tooltips.html"><i class="icofont icofont-cursor-drag"></i> Tooltips</a>
                           <a href="https://askbootstrap.com/preview/osahan-fashion/typography.html"><i class="icofont icofont-line-height"></i> Typography</a>
                        </div>
                     </div>
                  </div>
               </div>
            </li>
            <li class="nav-item dropdown">
               <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               Blog
               </a>
               <div class="dropdown-menu">
                  <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-fashion/blog-right.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Blog &ndash; Right Sidebar </a>
                  <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-fashion/blog-left.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Blog &ndash; Left Sidebar </a>
                  <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-fashion/blog.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Blog &ndash; Full-Width </a>
                  <a class="dropdown-item" href="https://askbootstrap.com/preview/osahan-fashion/blog-single.html"><i class="fa fa-angle-right" aria-hidden="true"></i> Single post </a> 
               </div>
            </li>
            <li class="nav-item">
               <a class="nav-link" href="https://askbootstrap.com/preview/osahan-fashion/contact.html">Contact</a>
            </li>
         </ul>
      </div>
   </div>
</nav>