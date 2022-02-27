@extends('employee.main_master')
@section('content')
    <div class="single-product shadow-box">
        <div class="back-btn">
            <a href="{{route('emp.shop')}}"><i class="bi bi-arrow-left-short"></i> Tilbage</a>
        </div><!-- Back button -->

        <div class="row">
            <div class="col-lg-7 col-md-12">
                <!--img-products-->
                @php $mutimages=DB::table('customize_multimgs')->where('customize_product_id',$product->product_id)->get(); @endphp
                <div class="img-products">
                    <div class="owl-carousel owl-theme big" id="big">
                        <div class="item">
                            <figure class="zoom" onmousemove="zoom(event)" style="background-image: url({{asset($product->product_thambnail) }})">
                                <img src="{{asset($product->product_thambnail) }}" />
                            </figure>
                        </div>
                        @foreach($mutimages as $mutimage)
                        <div class="item">
                            <figure class="zoom" onmousemove="zoom(event)" style="background-image: url({{asset($mutimage->photo_name) }})">
                                <img src="{{asset($mutimage->photo_name) }}" />
                        </figure>
                        </div>
                        @endforeach

                    </div>

                    <!--thumbs-->
                    <div class="owl-carousel owl-theme" id="thumbs">
                        <div class="item">
                            <img alt="" class="img-responsive" src="{{asset($product->product_thambnail) }}"/>
                        </div>
                        @foreach($mutimages as $mutimage)
                            <div class="item">
                                <img alt="" class="img-responsive" src="{{asset($mutimage->photo_name) }}"/>
                            </div>
                        @endforeach

                    </div><!--/thumbs-->
                </div><!--/img-products-->


            </div>
            <div class="col-lg-5 col-md-12">
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
                <div class="product-info">
                    <h1>{{$product->product_name}}</h1>
                    <div class="select-product-type">
                        @if($product->status=='pending')
                        <form action="{{route('emp.post')}}" method="post">
                            @csrf
                            <input type="hidden" name="order_emp_id" value="{{$product->id}}">
                            <input type="hidden" name="employee_id" value="{{$product->employee_id}}">
                            <input type="hidden" name="product_name" value="{{$product->product_name}}">


                            <input type="hidden" name="product_thambnail" value="{{$product->product_thambnail}}">
                            @if($product->name_on_product=='yes')
                            <div class="form-group">
                                <input type="text" class="form-control" name="label" placeholder="{{__('Write name label')}}" required>
                            </div>
                            @endif
                            @php $distincts = DB::table('customize_product_attributes')->distinct()->select('attribute_id')->where('product_id', '=',$product->product_id)->get();
                            @endphp


                            @foreach($distincts as $distinct)
                                @php $attributs=DB::table('customize_product_attributes')->where('product_id',$product->product_id)->where('attribute_id',$distinct->attribute_id)->get();@endphp
                                <div class="form-group"><select name="{{\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name')}}" class="form-control" required><option value="">{{__('Choose')}} {{__(\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name'))}}</option>

                                @php $atttt=[];@endphp
                                @foreach($attributs as $key=>$attribut)
                                    @php
                                    $ddddd=\App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_value');
                                    $atttt[$ddddd]=\App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_order');
                                    @endphp
                                @endforeach
                                @php
                                asort($atttt);
                                @endphp

                                @foreach ($atttt as $key11=>$value)
                                    <option value="{{ $key11 }}">{{ $key11 }}</option>
                                @endforeach

                                {{--@foreach($attributs as $attribut)
                                    <option value="'.\App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_value').'">{{ \App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_value')}}</option>
                                @endforeach--}}
                                </select></div>
                            @endforeach


                            <div class="form-group">
                                <button class="btn btn-blue">{{__('Approve')}}</button>
                            </div>
                        </form>
                        @else
                        <button class="btn btn-success">{{__('Approved')}}</button>
                        @endif
                    </div>
                </div><!-- Product info -->
            </div>
        </div>
    </div><!-- Single product -->
@endsection
