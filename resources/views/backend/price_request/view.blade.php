@extends('admin.admin_master')
@section('css')
    <link href="{{ asset('backend/assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
    <style>
        .product-color span {
            font-size: 1.688rem;
            font-weight: 700;
            display: inline-block;
            margin-right: 5px;
        }
        .product-color ul li {
            background: #E3E3E3;
            width: 25px;
            height: 25px;
            border-radius: 100%;
            margin: 0 5px;
            border: 1px solid #e3e3e3;
        }
        .product-color ul.Size li {
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 15px;
        }
        .product-color ul.Color li {
            font-size: 0;
        }
    </style>
@endsection

@section('admin')


	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Company Fill </h4>
              <a href="{{ route('companyp.pdf',$product->id)}}" class="btn btn-file btn-info pull-right" >Download PDF</a>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">

                    <!--<div class="row">
                        <div class="col-12">
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <td>{{ \App\Models\User::where('id',$product->user_id)->value('name') }}</td>

                                    <th>Company</th>
                                    <td>{{ \App\Models\User::where('id',$product->user_id)->value('company') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-6">
                            @if($product->logo_on_product==1)
                                <table  class="table">
                                    <tr>
                                        <th>Logo on the product</th>
                                        <td>@if($product->logo_on_product==1) Yes @else No @endif</td>
                                    </tr>
                                </table>
                                <div style="text-align:center; font-weight:bold">
                                    @if(!empty($product->logo_front_left)) {{$product->logo_front_left}}, @endif
                                    @if(!empty($product->logo_front_right)){{$product->logo_front_right}}, @endif
                                    @if(!empty($product->logo_shoulder_left)){{$product->logo_shoulder_left}},@endif
                                    @if(!empty($product->logo_shoulder_right)){{$product->logo_shoulder_right}}, @endif
                                    @if(!empty($product->logo_onthe_back_side)){{$product->logo_onthe_back_side}}, @endif
                                </div>
                                {{--
                                <tr>
                                    <th>Front left</th>
                                    <td>@if(!empty($product->logo_front_left)) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <th>Front right</th>
                                    <td>@if(!empty($product->logo_front_right)) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <th>Shoulder left</th>
                                    <td>@if(!empty($product->logo_shoulder_left)) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <th>Shoulder right</th>
                                    <td>@if(!empty($product->logo_shoulder_right)) Yes @else No @endif</td>
                                <tr>
                                <tr>
                                    <th>On the backside</th>
                                    <td>@if(!empty($product->logo_onthe_back_side)) Yes @else No @endif</td>
                                </tr>
                                --}}
                            @endif
                        </div>
                        <div class="col-6">
                            @if($product->text_on_product==1)
                                <table  class="table">
                                    <tr>
                                        <th>Text on the product</th>
                                        <td>@if($product->text_on_product==1) Yes @else No @endif</td>
                                    </tr>
                                </table>
                                <div style="text-align:center; font-weight:bold">@if(!empty($product->text_front_left)) {{$product->text_front_left}}, @endif
                                @if(!empty($product->text_front_right)){{$product->text_front_right}}, @endif
                                @if(!empty($product->text_shoulder_left)){{$product->text_shoulder_left}}, @endif
                                @if(!empty($product->text_shoulder_right)){{$product->text_shoulder_right}}, @endif
                                @if(!empty($product->text_onthe_back_side)){{$product->text_onthe_back_side}}, @endif
                                </div>
                                {{--
                                <tr>
                                    <th>Front left</th>
                                    <td>@if(!empty($product->text_front_left)) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <th>Front right</th>
                                    <td>@if(!empty($product->text_front_right)) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <th>Shoulder left</th>
                                    <td>@if(!empty($product->text_shoulder_left)) Yes @else No @endif</td>
                                </tr>
                                <tr>
                                    <th>Shoulder right</th>
                                    <td>@if(!empty($product->text_shoulder_right)) Yes @else No @endif</td>
                                <tr>
                                <tr>
                                    <th>On the backside</th>
                                    <td>@if(!empty($product->text_onthe_back_side)) Yes @else No @endif</td>
                                </tr>
                                --}}
                            @endif
                        </div>

                        <div class="col-12">
                        <hr />
                            <p>Description</p>
                            {{$product->message}}
                        </div>
                        <div class="col-12">
                        <hr />
                        @if(!empty($product->logo))
                        <p><a href="{{ asset($product->logo)}}" class="btn btn-file btn-info" download>Click here to download Attachment</a></p>
                        @endif
                        @if(!empty($product->profile_logo))
                        <p><a href="{{ asset('public/uploads/admin_images/'.Auth::user()->profile_photo_path)}}" class="btn btn-file btn-info" download>Click here to download Attachment</a></p>
                        @endif
                        </div>
                    </div>-->

                    <!-- price-product -->
                    <div class="price-product">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="pro_name">
                                    <h3>Name: <strong>{{ \App\Models\User::where('id',$product->user_id)->value('name') }}</strong></h3>
                                    <h3>Company Name: <strong>{{ \App\Models\User::where('id',$product->user_id)->value('company') }}</strong></h3>

                                </div>
                            </div>

                            <div class="col-md-6">

                                    <p>
                                    @if(!empty($product->profile_logo))
                                        <a href="{{ asset($product->profile_logo)}}" class="btn btn-file btn-info" download>Click here to download Attachment</a>
                                    @endif
                                    @if(!empty($product->logo))
                                        <a href="{{ asset($product->logo)}}" class="btn btn-file btn-info" download>Click here to download Uploads</a>
                                    @endif
                                    </p>

                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            @if($product->logo_on_product==1)
                            <div class="col-md-6">
                                <div class="pro_cont">
                                    <h4>Do you want your logo on the product? <span class="ys-no"><strong>&nbsp;&nbsp;@if($product->logo_on_product==1) Yes @else No @endif</strong></span></h4>
                                </div>

                                <div class="pro_cont">
                                    <h4>Where do you want your logo position?</h4>

                                    <ul>
                                    @if(isset($product->logo_value)&&!empty($product->logo_value))
                                        @php $arraylogoposition=explode('|',$product->logo_value); @endphp
                                        @foreach($arraylogoposition as $key=>$logoposition)
                                         <li>{{$logoposition}}</li>
                                        @endforeach
                                    @endif
                                        {{--
                                        @if(!empty($product->logo_front_left))<li>{{$product->logo_front_left}}</li> @endif
                                        @if(!empty($product->logo_front_right))<li>{{$product->logo_front_right}}</li> @endif
                                        @if(!empty($product->logo_shoulder_left))<li>{{$product->logo_shoulder_left}}</li>@endif
                                        @if(!empty($product->logo_shoulder_right))<li>{{$product->logo_shoulder_right}}</li> @endif
                                        @if(!empty($product->logo_onthe_back_side))<li>{{$product->logo_onthe_back_side}}</li> @endif --}}
                                    </ul>
                                </div>
                            </div>
                            @endif
                            @if($product->text_on_product==1)
                            <div class="col-md-6">
                                <div class="pro_cont">
                                    <h4>Do you want to assign a text to the product? <span class="ys-no"><strong>&nbsp;&nbsp;@if($product->text_on_product==1) Yes @else No @endif</strong></span></h4>
                                </div>

                                <div class="pro_cont">
                                    <h4>Where do you want your text position?</h4>

                                    <ul>
                                        @if(isset($product->text_value)&&!empty($product->text_value))
                                            @php $arraylogoposition=explode('|',$product->text_value); @endphp
                                            @foreach($arraylogoposition as $key=>$logoposition)
                                            <li>{{$logoposition}}</li>
                                            @endforeach
                                        @endif
                                        {{--
                                        @if(!empty($product->text_front_left))<li>{{$product->text_front_left}}</li> @endif
                                        @if(!empty($product->text_front_right))<li>{{$product->text_front_right}}</li>@endif
                                        @if(!empty($product->text_shoulder_left))<li>{{$product->text_shoulder_left}}</li> @endif
                                        @if(!empty($product->text_shoulder_right))<li>{{$product->text_shoulder_right}}</li> @endif
                                        @if(!empty($product->text_onthe_back_side))<li>{{$product->text_onthe_back_side}}</li> @endif --}}
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="description">
                                    <h4>Description :</h4>
                                    <p>{{$product->message}}</p>
                                </div>
                            </div>
                        </div>

                    </div><!-- /price-product -->



				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
          @if(!empty($distincts))
         <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Product Detail </h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
                    {{--$product--}}

                    <div class="row">
                    <div class="col-4">
                           <img src="{{ asset($product->product->product_thambnail)}}" style="max-width:auto" height="auto" width="auto">
                        </div>
                        <div class="col-8">
                            <h2>{{$product->product->product_name}}</h2>
                            <h4>Price : {{$product->product->product_price}} SKU : {{$product->product->product_sku}}</h4>
                            <h4>Brand :
                            {{ \App\Models\Brand::where('id',$product->product->brand_id)->value('brand_name') }}</h4>
                            <h4>Category : {{ \App\Models\Category::where('id',$product->product->category_id)->value('category_name') }}</h4>
                            <div class="product-color d-flex1 align-items-center">


                            @foreach($distincts as $distinct)
                                @php
                                $attributs=DB::table('product_attributes')->where('product_id',$product->product->id)->where('attribute_id',$distinct->attribute_id)->get();
                                @endphp
                                <span>{{\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name')}} :</span>
                                <ul class="d-flex {{\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name')}}">

                                @foreach($attributs as $attribut)
                                    <li class="color " style="background-color:{{\App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_code')}}">{{ \App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_value')}}</li>
                                @endforeach
                                </ul>
                            @endforeach

                            </div><!-- Product color -->


                        </div>


                    </div>


				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->
        @endif

		</section>








		<!-- /.content -->
	  </div>



@endsection
@section('js')
<!-- /// Tgas Input Script -->
<script src="{{ asset('./assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js') }}"></script>
<script src="{{ asset('./assets/vendor_components/select2/dist/js/select2.full.js') }}"></script>
<!-- // CK EDITOR  -->
 <script src="{{ asset('./assets/vendor_components/ckeditor/ckeditor.js') }}"></script>
 <script src="{{ asset('./assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}"></script>

 <script>
 $(function () {
    "use strict";

    //Initialize Select2 Elements
    $('.select2').select2();

    //CKEDITOR.replace('editor2');
	//bootstrap WYSIHTML5 - text editor
	$('.textarea').wysihtml5();

 });
 </script>
 <script type="text/javascript">
	function mainThamUrl(input){
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e){
				$('#mainThmb').attr('src',e.target.result).width(80).height(80);
			};
			reader.readAsDataURL(input.files[0]);
		}
	}
</script>


<script>

  $(document).ready(function(){
   $('#multiImg').on('change', function(){ //on file input change
      if (window.File && window.FileReader && window.FileList && window.Blob) //check File API supported browser
      {
          var data = $(this)[0].files; //this file data

          $.each(data, function(index, file){ //loop though each file
              if(/(\.|\/)(gif|jpe?g|png)$/i.test(file.type)){ //check supported file type
                  var fRead = new FileReader(); //new filereader
                  fRead.onload = (function(file){ //trigger function on successful read
                  return function(e) {
                      var img = $('<img/>').addClass('thumb').attr('src', e.target.result) .width(80)
                  .height(80); //create image element
                      $('#preview_img').append(img); //append image to output element
                  };
                  })(file);
                  fRead.readAsDataURL(file); //URL representing the file's data.
              }
          });

      }else{
          alert("Your browser doesn't support File API!"); //if File API is absent
      }
   });
  });

  </script>

<script>
$(document).ready(function() {
    var child_cateid={{$product->subcategory_id}};
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
                        $("#subcategory_id").append('<option>---- Select Subcategory---</option>');
                            $.each(data,function(key,value){
                                console.log(value.subcategory_name);
                            $("#subcategory_id").append('<option value="'+value.id+'" '+(value.id==child_cateid?'selected':'')+'>'+value.subcategory_name+'</option>');
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
    if(child_cateid!=null){
        $('select[name="category_id"]').change();
    }
});
</script>

@endsection
