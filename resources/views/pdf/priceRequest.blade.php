<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Pdf Download</title>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            padding: 30px;

        }

        .invoice-wrap {
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 15px;
            position: relative;
            overflow: hidden;
        }

        h3{
            font-size: 18px;
        }

        ul {
            padding: 0;
        }

        ul li {
            list-style: none;
            font-size: 14px;
            line-height: 1.4;
        }
        p{
            font-size: 14px;
        }

        .logo {
            display: block;
            margin: 0 auto 40px;
            text-align: center;
        }

        .logo a {
            display: block;
        }

        .logo a img {
            height: 24px;
        }

        .bg-first {
            position: absolute;
            right: -37px;
            height: 160px;
            width: 160px;
            background: #001fd1;
            border-radius: 45px;
            top: -107px;
            transform: rotate(45deg);
        }

        .bg-sec {
            position: absolute;
            left: -56px;
            height: 160px;
            width: 259px;
            background: #161615;
            border-radius: 45px;
            transform: rotate(15deg);
            bottom: -70px;
            z-index: 1;
        }

        .bg-sec2 {
            position: absolute;
            left: -65px;
            height: 160px;
            width: 327px;
            background: #001fd1;
            border-radius: 45px;
            transform: rotate(15deg);
            bottom: -59px;
            z-index: 0;
        }



        h5 {
            font-size: 16px;
            margin-top: 30px;
        }

        h5 span {
            width: 50px;
            height: 2px;
            background: #848484;
            display: inline-block;
        }


    </style>
</head>

<body>

    <div class="pdf-section">

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="invoice-wrap">
                    <div class="bg-first"></div>

                    <div class="logo"><a href="#"><img src="http://50.116.13.170/sortiment/frontend/assets/img/sortiment-logo.png"
                        alt="sortiment" class="img-fluid"></a></div>
                        <br>
                    <br> <br>

                    <div class="clearfix"></div>

                    <div class="row">
                        <div class="col-md-12" style="width:48%;float:left;">
                            <div class="product-name">
                                <h3>Product Name : <strong>{{ \App\Models\User::where('id',$product->user_id)->value('name') }}</strong></h3>
                                <h3>Company Name : <strong>{{ \App\Models\User::where('id',$product->user_id)->value('company') }}</strong></h3>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-12" style="width:48%;float:right">
                            <div class="product-img">
                             @if(!empty($product->profile_logo))
                                    <p><a href="{{ asset('public/uploads/admin_images/'.Auth::user()->profile_photo_path)}}" class="btn btn-file btn-info" download>Click here to download Attachment</a></p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br> <hr> <br>

                    <div class="row">
                        @if($product->logo_on_product==1)
                        <div class="col-md-12" style="width:48%;float:left;">
                            <h3>Do you want your logo on the product? <strong>&nbsp;&nbsp; @if($product->logo_on_product==1) Yes @else No @endif</strong></h3>
                            <hr>
                            <p><strong>Where do you want your logo position?</strong></p>
                            <ul>
                            <ul>
                                @if(isset($product->logo_value)&&!empty($product->logo_value))
                                    @php $arraylogoposition=explode('|',$product->logo_value); @endphp
                                    @foreach($arraylogoposition as $key=>$logoposition)
                                        <li>{{$logoposition}}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        @endif
                        <div class="clearfix"></div>
                        @if($product->text_on_product==1)
                        <div class="col-md-12" style="width:48%;float:right;">
                            <h3>Do you want to assign a text to the product? <strong>&nbsp;&nbsp;@if($product->text_on_product==1) Yes @else No @endif</strong></h3>
                            <hr>
                            <p><strong>Where do you want your text position?</strong></p>
                            <ul>
                                @if(isset($product->text_value)&&!empty($product->text_value))
                                    @php $arraylogoposition=explode('|',$product->text_value); @endphp
                                    @foreach($arraylogoposition as $key=>$logoposition)
                                    <li>{{$logoposition}}</li>
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-12" style="width:100%;">
                            <div class="description">
                                <p><strong>Description :</strong></p>
                                <p>{{$product->message}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <br> <hr> <br>

                    @if(isset($distincts))
                    <div class="row">
                        <div class="col-md-6" style="width:48%;float:left;">
                            <img src="{{ asset($product->product->product_thambnail)}}" style="width: 100%;">
                        </div>
                        <div class="clearfix"></div>
                        <div class="col-md-6" style="width:48%;float:right;">
                            <div class="product-dte">
                                <h3>{{$product->product->product_name}}</h3>
                                <p><strong>Price : </strong>{{$product->product->product_price}} SKU : {{$product->product->product_sku}}</p>
                                <p><strong>Brand : </strong>{{ \App\Models\Brand::where('id',$product->product->brand_id)->value('brand_name') }}</p>
                                <p><strong>Category : </strong>{{ \App\Models\Category::where('id',$product->product->category_id)->value('category_name') }}</p>


                                @foreach($distincts as $distinct)
                                @php
                                $attributs=DB::table('product_attributes')->where('product_id',$product->product->id)->where('attribute_id',$distinct->attribute_id)->get();
                                @endphp
                                <p><strong>{{\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name')}} :</strong></p>
                                <ul class="{{\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name')}}">

                                @foreach($attributs as $attribut)
                                    <li class="color" >- {{ \App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_value')}}</li>
                                @endforeach
                                </ul>
                                @endforeach

                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    @endif
                    <br>
                    <br>
                    <br>

                    <div class="bg-sec"></div>
                    <div class="bg-sec2"></div>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>

</html>
