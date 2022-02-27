@extends('company.main_master')
@section('content')


<div class="welcom-popup shadow-box text-center">
    <a href="#" class="round-btn" onClick="$(this).parent().remove()"><i class="bi bi-x-lg"></i></a>
    <h1>{{__('Welcome to the shop')}}</h1>
    <p>{{__('Here you can see all of our products click on any of them to get the right price just for you!')}}</p>
</div><!-- Welcom popup -->
<section class="product-filter-sec ptb-45">
    <div class="filters">
        <form class="row g-3" method="get" action="">
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select" name="category" onchange="submitfilter()">
                        <option value="">{{__('Category')}}</option>
                        @foreach($categories as $category)
                        <option value="{{$category->id}}" @if( request()->get('category')==$category->id){{'selected'}} @endif>{{$category->category_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div><!-- Col -->
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select name="subcategory" class="form-control" class="subcategory_id" id="subcategory_id" onchange="submitfilter()">
                        <option value="" selected="" >{{__('Select SubCategory')}}</option>
                        @if(!empty($subcategory))
                            @foreach($subcategory as $scategory)
                                <option value="{{$scategory->id}}" @if( request()->get('subcategory')==$scategory->id){{'selected'}} @endif>{{$scategory->subcategory_name}}</option>
                            @endforeach
                        @endif
                    </select>

                </div>
            </div> <!-- end col md 4 -->
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select" name="brand" onchange="submitfilter()">
                        <option  value="">{{__('Brand')}} </option>
                        @foreach($brands as $brand)
                        <option value="{{$brand->id}}" @if( request()->get('brand')==$brand->id){{'selected'}} @endif>{{$brand->brand_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div><!-- Col -->
            @php $i=0;

            if( request()->get('attribute')){
                $attrib=request()->get('attribute');
            }
            @endphp
            @foreach($attributes as $key=>$attribute)
            @if($attribute->attr_name=="Color")


           <!-- =============BackUp Code Start 26-10-2021============== -->

         <!--    <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select" name="attribute[{{$attribute->id}}][]" onchange="submitfilter()">
                        <option  value="">---{{__($attribute->attr_name)}}---</option>
                        @foreach($attribute->values as $attrValue)
                        <option value="{{$attrValue->id}}" @if( @$attrib[$attribute->id][0]==$attrValue->id){{'selected'}} @endif>{{$attrValue->attr_value}}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->

         <!-- =============BackUp Code End 26-10-2021============== -->

             <div class="col-lg-3 col-md-6">
                <div class="dropdown custom-color-dropdown">
                    <input type="hidden" name="attribute[{{$attribute->id}}][]" id="attrvvv">

                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                    {{__($attribute->attr_name)}}
                    </button>
                    <ul class="dropdown-menu">
                        <?php //array_unique($attribute->values) ?>
                        @foreach($attribute->values as $attrValue)
                            <li><a class="dropdown-item" href="#" style="background-color:{{$attrValue->attr_code}}" onclick="colorarr(this,{{$attrValue->id}})"></a></li>
                        @endforeach
                    </ul>
                </div>



                   <!--  <select class="form-select" name="attribute[{{$attribute->id}}][]" onchange="submitfilter()">
                        <option  value="">---{{__($attribute->attr_name)}}---</option>
                        @foreach($attribute->values as $attrValue)
                        <option value="{{$attrValue->id}}" @if( @$attrib[$attribute->id][0]==$attrValue->id){{'selected'}} @endif>{{$attrValue->attr_value}}</option>
                        @endforeach
                    </select> -->
                <!-- </div> -->
            </div>

            <!-- Col -->



            @endif
            @php $i=$i+1; @endphp
            @endforeach

        </form><!-- Filter form -->
    </div><!-- Filters -->
</section><!-- Product Filter -->

<section class="row product-items d-flex justify-content-between1 ">
    @foreach($products as $product)
    <div class="col-md-3">
    <div class="product-item shadow-box text-center">
        <a href="{{route('product.detail',$product->id)}}" class="product-img"><img src="{{asset($product->product_thambnail) }}" alt="Product"></a>
        <h5><a href="#">{{$product->product_name}}</a></h5>
        <p class="price">{{__('Request a price')}}</p>
    </div><!-- Product item -->
    </div>
    @endforeach

</section><!-- Product items -->
@endsection
@section('js')
<script>
    function submitfilter(){
        $("form").submit();
    }
    function colorarr(that,id){
        $('#attrvvv').val(id);
        $("form").submit();
    }
</script>
<script>
$(document).ready(function() {

    $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id) {
            $.ajax({
                url: "{{  url('/category/subcategory/ajax') }}/"+category_id,
                type:"GET",
                //dataType:"json",
                success:function(data) {
                    if(data){
                        console.log(data);
                        $("#subcategory_id").empty();
                        $("#subcategory_id").append('<option value="">---- Select Subcategory---</option>');
                            $.each(data,function(key,value){
                                console.log(value.subcategory_name);
                            $("#subcategory_id").append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                            });
                            console.log($("#subcategory_id"));
                        }else{
                            $("#subcategory_id").empty();
                        }
                    //$('.subcategory').html(data);

                    //$("#subcategory_id").niceSelect('update');
                    //$("#subcategory_id").niceSelect('refresh');
                },
            });
        } else {
            alert('danger');
        }
    });

});

</script>
@endsection
