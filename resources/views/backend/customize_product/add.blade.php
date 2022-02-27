@extends('admin.admin_master')
@section('css')
    <!--<link href="{{ asset('backend/assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />-->
@endsection

@section('admin')


	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">{{__('Add product')}} </h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
                    <form method="post" action="{{ route('cproduct.store') }}" enctype="multipart/form-data" >
		 	            @csrf
					  <div class="row">
                        <div class="col-12">

                            <div class="row"> <!-- start 1nd row  -->

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <h5>{{__('Product name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name" class="form-control" value="{{ old('product_name') }}">
                                            @error('product_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Request price')}} </h5>
                                        <div class="controls">
                                            <select name="request_id" class="form-control select2"  require>
                                                <option value="" selected="" disabled="">{{__('Select request')}}</option>
                                                @foreach($PriceRequest as $ddata)
                                                <option value="{{ $ddata->id }}" @if($ddata->id==old('request_id')) selected @endif>{{\App\Models\Product::where('id',$ddata->product_id)->value('product_name')}} ({{\App\Models\User::where('id',$ddata->user_id)->value('company')}})</option>
                                                @endforeach
                                            </select>
                                            @error('request_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                <!--<div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Category Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control select2"  require>
                                                <option value="" selected="" disabled="">Select Category</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}" @if($category->id==old('category_id')) selected @endif>{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>--> <!-- end col md 4 -->
                                <!--<div class="col-md-4">
                                    <div class="form-group">
                                        <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_id" class="form-control" class="subcategory_id" id="subcategory_id">
                                                <option value="" selected="" disabled="">Select SubCategory</option>
                                            </select>
                                            @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                </div>--> <!-- end col md 4 -->
                            </div> <!-- end 1nd row  -->

                            <div class="row"> <!-- start 3RD row  -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Brand select')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="brand_id" class="form-control select2"  >
                                                <option value="" selected="" disabled="">{{__('Select brand')}}</option>
                                                @foreach($brands as $brand)
                                                <option value="{{ $brand->id }}" @if($brand->id==old('brand_id')) selected @endif>{{ $brand->brand_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('brand_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Product SKU')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_sku" class="form-control" value="{{ old('product_sku') }}" require>
                                            @error('product_sku')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Product PDF')}} </h5>
                                        <div class="controls">
                                            <input type="file" name="product_pdf" class="form-control" require>
                                            @error('product_pdf')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror


                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->



                            </div> <!-- end 3RD row  -->

                            <div class="row"> <!-- start 5th row  -->
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>{{__('Product Price')}} <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_price" class="form-control" value="{{ old('product_price') }}" require>
                                                    @error('product_price')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>{{__('Company')}} <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="user_id" class="form-control select2"  >
                                                        <option value="" selected="" disabled="">{{__('Select company')}}</option>
                                                        @foreach($users as $user)
                                                        <option value="{{ $user->id }}" @if($user->id==old('user_id')) selected @endif>{{ $user->company }} ({{ $user->name }})</option>
                                                        @endforeach
                                                    </select>
                                                    @error('user_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div>
                                    <div class="row"> <!-- start 6th row  -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>{{__('Product image')}} <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)" require>
                                                    @error('product_thambnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <img src="" id="mainThmb">

                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>{{__('Multiple image')}} </h5>
                                                <div class="controls">
                                                    <input type="file" name="multi_img[]" class="form-control"  multiple="" id="multiImg"   >
                                                    @error('multi_img')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                    <div class="row" id="preview_img"></div>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 4 -->
                                    </div> <!-- end 6th row  -->

                                    <div class="row"> <!-- start 8th row  -->
                                        @foreach($attributes as $attribute)
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h5>{{__($attribute->attr_name)}} </h5>
                                                <input type="hidden" value="{{$attribute->id}}" name="attr_id[]">
                                                <div class="controls">
                                                    <select name="attrval_id[{{$attribute->id}}][]" class="form-control select2" multiple >
                                                        @foreach($attribute->values as $value)
                                                        <option value="{{ $value->id }}">{{ $value->attr_value }} </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> <!-- end col md 6 -->
                                        @endforeach
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>{{__('Name on product')}}<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="name_on_product" class="form-control" >
                                                        <option value="" selected="" disabled="">{{__('Select name on product')}}</option>
                                                        <option value="yes" >{{__('Yes')}}</option>
                                                        <option value="no" >{{__('No')}}</option>
                                                    </select>
                                                    @error('name_on_product')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end 128th col  -->
                                        <div class="col-md-6 ">
                                            <div class="form-group">
                                                <h5>{{__('Delivery from')}} <small>{{__('no of days')}}</small></h5>
                                                <div class="controls">
                                                    <input type="number" name="delevery_days" min="1" class="form-control">

                                                </div>
                                                <p>{{__('Ex 5 ( this no exclude no of day on checkout page)')}} </p>
                                            </div>
                                        </div> <!-- end 128th col  -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>{{__('Express delivery status')}}<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <fieldset>
                                                        <input type="radio" id="checkbox_2" name="express_delivery_status" value="0" checked>
                                                        <label for="checkbox_2">{{__('Nej')}}</label>
                                                    </fieldset>
                                                    <fieldset>
                                                        <input type="radio" id="checkbox_3" name="express_delivery_status" value="1">
                                                        <label for="checkbox_3">{{__('Yes')}}</label>
                                                    </fieldset>
                                                    @error('express_delivery_status')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div> <!-- end 128th col  -->
                                        <div class="col-md-6 deliverystatuson" style="display:none">
                                            <div class="form-group">
                                                <h5>{{__('Express delivery before')}} <small>{{__('no of days')}}</small></h5>
                                                <div class="controls">
                                                    <input type="number" name="express_delivery_days" min="1" class="form-control">
                                                </div>
                                                <p>{{__('Express delivery ( this no exclude no of day on checkout page)')}} </p>
                                            </div>
                                        </div> <!-- end 128th col  -->

                                    </div> <!-- end 8th row  -->
                                </div>
                                <div class="col-md-4">
                                    <table class="table" id="qtyPrice">
                                        <thead>
                                            <th>{{__('Qty')}}</th>
                                            <th>{{__('Price')}}</th>
                                            <th>{{__('Action')}}</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><input class="form-control" type="number" value="0"  name="qty[]"></td>
                                                <td>
                                                    <input class="form-control" type="number" value="0" name="price[]">
                                                    @error('price1')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                                <td></td>
                                            </tr>
                                            <!--
                                            <tr>
                                                <td><input class="form-control" type="text" value="10" readonly name="qty2"></td>
                                                <td>
                                                    <input class="form-control" type="number" value="{{ old('price2') }}" name="price2">
                                                    @error('price2')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control" type="text" value="25" readonly name="qty3"></td>
                                                <td>
                                                    <input class="form-control" type="number" value="{{ old('price3') }}" name="price3">
                                                    @error('price3')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control" type="text" value="50" readonly name="qty4"></td>
                                                <td>
                                                    <input class="form-control" type="number" value="{{ old('price4') }}" name="price4">
                                                    @error('price4')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><input class="form-control" type="text" value="100+" readonly name="qty5"></td>
                                                <td>
                                                    <input class="form-control" type="number" value="{{ old('price5') }}" name="price5">
                                                    @error('price5')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </td>
                                            </tr>-->
                                        </tbody>



                                    </table>
                                    <button class="btn btn-primary pull-right mr-15" id="addprice" type="button" ><i class="fa fa-plus-circle"></i></button>
                                </div>
                            </div> <!-- end 5th row  -->
                            <div class="row"> <!-- start 7th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>{{__('Description')}} </h5>
                                        <div class="controls">
                                            <textarea name="description" id="textarea" class="form-control textarea" placeholder="Textarea text" >{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 7th row  -->
                            <div class="row"> <!-- start 8th row  -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Meta title')}} </h5>
                                        <div class="controls">
                                            <input type="text" name="meta_title" value="{{ old('meta_title') }}" class="form-control">
                                            @error('meta_title')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Meta Description')}} </h5>
                                        <div class="controls">
                                            <input type="text" name="meta_desc" value="{{ old('meta_desc') }}" class="form-control">
                                            @error('meta_desc')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Meta tag')}} </h5>
                                        <div class="controls">
                                            <input type="text" name="meta_tag" value="{{ old('meta_tag') }}" class="form-control">
                                            @error('meta_tag')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                            </div> <!-- end 8th row  -->


                        </div>
                    </div>

						<div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="{{__('Add product')}}">
						</div>
					</form>

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

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

    //append price qty js
    $('#addprice').on('click', function(){
        $('#qtyPrice').append(`<tr><td><input type="number" class="form-control" name="qty[]"></td><td><input type="number" class="form-control" name="price[]"></td><td><button class="btn btn-danger" type="button" onclick="confirm('Are you sure?') ? $(this).parent().parent().remove() : false"><i class="fa fa-minus-circle"></i></button></td></tr>`);
    });
});



$("input[name='express_delivery_status']").on("click",function()
{
      var radioselected  = $(this).val();
      if(radioselected=="1")
      {
         $(".deliverystatuson").css("display","block");
      }else{
        $(".deliverystatuson").css("display","none");
      }
});

</script>

@endsection
