@extends('company.main_master')
@section('content')
    <div class="welcom-popup shadow-box text-center">
        <a href="#" class="round-btn"><i class="bi bi-x-lg"></i></a>
        <h1>{{__('Welcome')}} {{Auth::user()->company}}</h1>
        <!--<p>Brug shoppen ligeså tosset du vil <br>Tøv ikke med at kontakte os hvis du har spørgsmål eller oplever udfordringer.</p>-->
        <p>Her vil du finde dit helt egen Sortiment</p>
    </div><!-- Welcom popup -->
    <section class="product-filter-sec ptb-45">
        <div class="filters">
            <form class="row g-3" method="get" action="">
                <div class="col-lg-3 col-md-6">
                    <div class="select">
                        <select class="form-select" name="status" onchange="submitfilter()">
                            <option value="">{{__('Choose status')}}</option>
                            <option value="pending" @if(isset($_GET['status']) && $_GET['status']=='pending') selected @endif>{{__('Pending approval')}}</option>
                            <option value="approved" @if(isset($_GET['status']) && $_GET['status']=='approved') selected @endif>{{__('Approved')}}</option>
                            <option value="ordered" @if(isset($_GET['status']) && $_GET['status']=='ordered') selected @endif>{{__('Ordered')}}</option>
                            <option value="denied" @if(isset($_GET['status']) && $_GET['status']=='denied') selected @endif>{{__('Denied')}}</option>
                        </select>

                    </div>
                </div><!-- Col -->
            </form><!-- Filter form -->
        </div><!-- Filters -->
    </section><!-- Product Filter -->
    <section class="row product-items d-flex justify-content-between1 flex-wrap">
        @foreach($products as $product)
        <div class="col-md-3">
        <div class="product-item shadow-box text-center">
            <span class="badge-default @if($product->status=='ordered'){{$product->status}} @elseif($product->status=='approved') {{$product->status}} @elseif($product->status=='denied') {{$product->status}} @else {{$product->status}} @endif">@if($product->status=='ordered') {{__('Ordered')}} @elseif($product->status=='approved') {{__('Approved')}} @elseif($product->status=='denied') {{__('Denied')}} @else {{__('Pending approval')}} @endif</span>

            <a href="{{route('cproduct.cstatus',$product->id)}}" class="product-img">
                @php
                // set a default image is_file(public_path() . '/' . $product->product_thambnail)
                // $pthumbnail= asset($product->product_thambnail);

                if ($product->product_thambnail) {
                        $image = asset($product->product_thambnail);
                    } else {
                        $image = asset('frontend/assets/img/product-img01.png');
                    }
                @endphp
                <img src="{{asset($image) }}" alt="Product">
            </a>
            @php
                $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
            @endphp
            <h5><a href="#">{{$product->product_name}}</a></h5>
            <p class="price">{{__('Price from')}}: {{$formatter->formatCurrency(round($product->product_price), 'DKK'), PHP_EOL;}} <small>(ex. moms)</small> </p>
        </div><!-- Product item -->
        </div>
        @endforeach
        <div class="paginate">
        {{-- $product->withQueryString()->links('vendor.pagination.default') --}}
        </div>
    </section><!-- Product items -->
@endsection
@section('js')
<script>
function addToCart(){
        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var color = $('#color option:selected').text();
        var size = $('#size option:selected').text();
        var quantity = $('#qty').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                color:color, size:size, quantity:quantity, product_name:product_name
            },
            url: "/cart/data/store/"+id,
            success:function(data){
                console.log(data)

                // Start Message
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message

            }
        })
    }
</script>

<script>
    function submitfilter(){
        $("form").submit();
    }
</script>

@endsection
