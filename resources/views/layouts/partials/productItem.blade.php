<div class="row products_page_list">
   <div class="clearfix"></div>
   @if($products)
    @foreach($products as $product)
    @php
     $images = explode('|',$product->thumbnail);                 
    @endphp
   <div class="col-lg-3 col-md-6">
      <div class="item">
         <div class="h-100">
            <div class="product-item">
               <span class="badge badge-info offer-badge">NEW</span>
               <!--
               <span class="badge badge-danger offer-badge">HOT</span> 
                -->
               <div class="product-item-image">
                  <span class="like-icon"><a href="#"> <i class="icofont icofont-heart"></i></a></span>
                  <a href="{{route('products.single',$product->slug)}}"><img class="card-img-top img-fluid" src="{{asset('image/'.$images[0])}}" alt=""></a>
               </div>
               <div class="product-item-body">
                  <div class="product-item-action">
                     <a data-toggle="tooltip" data-placement="top" title="" class="btn btn-theme-round btn-sm" href="{{route('products.addToCart',$product)}}" data-original-title="Add To Cart"><i class="icofont icofont-shopping-cart"></i></a>
                     <a data-toggle="tooltip" data-placement="top" title="" class="btn btn-theme-round btn-sm" href="{{route('products.single',$product)}}" data-original-title="View Detail"><i class="icofont icofont-search-alt-2"></i></a>
                  </div>
                  <h4 class="card-title"><a href="{{route('products.single',$product)}}">{{$product->name}}</a></h4>
                  <h5>
                     <span class="product-desc-price">$529.99</span>
                     <span class="product-price">{{$product->price}}</span>
                     <span class="product-discount">30% Off</span>
                  </h5>
               </div>
               <div class="product-item-footer">
                  <div class="product-item-size">
                     <strong>Size</strong> <span>S</span> <span>M</span> <span>L</span> <span> XL</span> <span> 2XL</span>
                  </div>
                  <div class="stars-rating">
                     <i class="icofont icofont-star active"></i>
                     <i class="icofont icofont-star active"></i>
                     <i class="icofont icofont-star active"></i>
                     <i class="icofont icofont-star"></i>
                     <i class="icofont icofont-star"></i> <span>(415)</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
    @endforeach
    @else
        <div class="col-lg-12 col-md-12 text-center">
            no data found
        </div>
    @endif

   
   <div class="col-lg-12 col-md-12">
      <div class="item">
         <a href="#">
         <img src="https://askbootstrap.com/preview/osahan-fashion/images/offers/home1_bn1.png" alt="">
         </a>
      </div>
   </div>                           
   <div class="col-lg-3 col-md-6">
      <div class="item">
         <div class="h-100">
            <div class="product-item">
               <span class="badge badge-default offer-badge">NEW</span>
               <div class="product-item-image">
                  <span class="like-icon"><a href="#"> <i class="icofont icofont-heart"></i></a></span>
                  <a href="#"><img class="card-img-top img-fluid" src="https://askbootstrap.com/preview/osahan-fashion/images/men/small/4.jpg" alt=""></a>
               </div>
               <div class="product-item-body">
                  <div class="product-item-action">
                     <a data-toggle="tooltip" data-placement="top" title="" class="btn btn-theme-round btn-sm" href="#" data-original-title="Add To Cart"><i class="icofont icofont-shopping-cart"></i></a>
                     <a data-toggle="tooltip" data-placement="top" title="" class="btn btn-theme-round btn-sm" href="#" data-original-title="View Detail"><i class="icofont icofont-search-alt-2"></i></a>
                  </div>
                  <h4 class="card-title"><a href="#">Ipsums Dolors Untra</a></h4>
                  <h5>
                     <span class="product-desc-price">$200.00</span>
                     <span class="product-price">$100.00</span>
                     <span class="product-discount">50% Off</span>
                  </h5>
               </div>
               <div class="product-item-footer">
                  <div class="product-item-size">
                     <strong>Size</strong> <span>S</span> <span>M</span> <span>L</span> <span> XL</span> <span> 2XL</span>
                  </div>
                  <div class="stars-rating">
                     <i class="icofont icofont-star active"></i>
                     <i class="icofont icofont-star active"></i>
                     <i class="icofont icofont-star active"></i>
                     <i class="icofont icofont-star active"></i>
                     <i class="icofont icofont-star active"></i> <span>(44)</span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>