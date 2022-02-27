@extends('company.main_master')
@section('content')  
<div class="welcom-popup shadow-box text-center">
    <a href="#" class="round-btn"><i class="bi bi-x-lg"></i></a>
    <h1>Welcome to the shop</h1>
    <p>Here you can see all of our products click on any of them to get the right price just for you!</p>
</div><!-- Welcom popup -->
<section class="product-filter-sec ptb-45">
    <div class="filters">
        <form class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select">
                        <option selected>Category</option>
                        <option>Select Category</option>
                        <option>Select Category</option>
                        <option>Select Category</option>
                    </select>
                </div>
            </div><!-- Col -->
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select">
                        <option selected>Size</option>
                        <option>Select Size</option>
                        <option>Select Size</option>
                        <option>Select Size</option>
                    </select>
                </div>
            </div><!-- Col -->
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select">
                        <option selected>Color</option>
                        <option>Select Color</option>
                        <option>Select Color</option>
                        <option>Select Color</option>
                    </select>
                </div>
            </div><!-- Col -->
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select">
                        <option selected>Brand</option>
                        <option>Select Brand</option>
                        <option>Select Brand</option>
                        <option>Select Brand</option>
                    </select>
                </div>
            </div><!-- Col -->
            </form><!-- Filter form -->
    </div><!-- Filters -->
</section><!-- Product Filter -->
<section class="product-items d-flex justify-content-between flex-wrap">
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img01.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img02.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img03.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img04.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img01.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img02.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img03.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img04.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img01.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img02.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img03.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img04.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img01.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img02.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img03.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/product-img04.png') }}" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
</section><!-- Product items -->
@endsection