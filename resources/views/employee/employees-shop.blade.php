@extends('employee.main_master')
@section('content')
<div class="welcom-popup shadow-box text-center">
    <a href="#" class="round-btn" onClick="$(this).parent().remove()"><i class="bi bi-x-lg"></i></a>
    <h1>{{__('Welcome to your products')}}</h1>
    <p>{{__('Your company has created a product on our page. Please fill out all the information about the product of each product below.')}}</p>
</div><!-- Welcom popup -->
<section class="product-filter-sec ptb-45">
    <div class="filters">
        <form action="" method="get" class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select name="status" class="form-select" onchange="submitfilter()">
                        <option value=''>{{__('Choose status')}}</option>
                        <option value="pending" @if( request()->get('status')=='pending' ) selected @endif>{{__('Pending')}}</option>
                        <option value="approved" @if( request()->get('status')=='approved' ) selected @endif>{{__('Approved')}}</option>
                    </select>
                </div>
            </div><!-- Col -->
            </form><!-- Filter form -->
    </div><!-- Filters -->
</section><!-- Product Filter -->

<section class="product-items d-flex justify-content-between flex-wrap">
    @foreach($allemp_orders as $products)
    <div class="product-item shadow-box text-center">
        <span class="badge-default {{$products->status}}">@if($products->status=='pending'){{__('Please fill your information')}}@else {{__('Approved')}} @endif</span>
        <a href="{{route('emp.detail',$products->id)}}" class="product-img"><img src="{{asset($products->product_thambnail) }}" width="245" alt="Product"></a>
        <h5><a href="{{route('emp.detail',$products->id)}}">{{$products->product_name}}</a></h5>
    </div><!-- Product item -->
    @endforeach
    {{--<div class="product-item shadow-box text-center">
        <span class="badge-default pending">Please fill your information</span>
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/single-product-img02.png') }}" width="245" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <span class="badge-default pending">Please fill your information</span>
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/single-product-img02.png') }}" width="245" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <span class="badge-default approved">Approved</span>
        <a href="#" class="product-img"><img src="{{asset('frontend/assets/img/single-product-img02.png') }}" width="245" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
    </div><!-- Product item -->--}}
</section><!-- Product items -->
@endsection
@section('js')
<script>
    function submitfilter(){
        $("form").submit();
    }
</script>

@endsection
