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
                    <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data" >
		 	            @csrf
					  <div class="row">
                        <div class="col-12">

                            <div class="row"> <!-- start 1nd row  -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Product name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_name" value="{{ old('product_name') }}" class="form-control">
                                            @error('product_name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Category select')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_ids[]" id="category_ids" class="form-control select2" multiple require>
                                                <option value="" disabled="">{{__('Category select')}}</option>
                                                @foreach($categories as $category)
                                                <option value="{{ $category->id }}"  @if($category->id==old('category_id')) selected @endif >{{ $category->category_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_ids[]')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            
                                        </div>
                                    </div>

                                </div> <!-- end col md 4 -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Select SubCategory')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="subcategory_ids[]" class="form-control select2" multiple id="subcategory_id">
                                                <option value=""  disabled="">{{__('Select SubCategory')}}</option>
                                            </select>
                                            @error('subcategory_ids.0')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->
                            </div> <!-- end 1nd row  -->

                            <div class="row"> <!-- start 3RD row  -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Brand select')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="brand_id" class="form-control select2"  >
                                                <option value="" selected="" disabled="">{{__('Brand select')}}</option>
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
                                        <h5>{{__('Product Price')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="product_price" class="form-control" value="{{ old('product_price') }}" require>
                                            @error('product_price')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div> <!-- end col md 4 -->

                            </div> <!-- end 3RD row  -->


                            <div class="row"> <!-- start 6th row  -->
                                <div class="col-md-4">
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
                                <div class="col-md-4">
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
                            </div> <!-- end 8th row  -->
                            <div class="row form-group">
                                <label for="" class="col-md-6 col-sm-12 col-form-label">{{__('Skal der logo på produktet?')}}</label>
                                <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end1">
                                    <div class="controls">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="noRadio" name="logo_on_product" value="0" checked >
                                            <label for="noRadio">{{__('No')}}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="yesRadio" name="logo_on_product" value="1">
                                            <label for="yesRadio">{{__('Yes')}}</label>
                                        </div>

                                    </div>
                                </div><!-- filed group -->
                            </div><!-- Form group -->
                            <div class="row"> <!-- start 8th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>{{__('Tilføj placering')}} </h5>
                                        <div class="controls">
                                            <select name="logo_value[]" class="form-control select2" multiple >
                                                @foreach($ProductLogoPostion as $LogoPostion)
                                                <option value="{{ $LogoPostion->positions }}">{{ $LogoPostion->positions }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 8th row  -->
                            <div class="row form-group">
                                <label for="" class="col-md-6 col-sm-12 col-form-label">{{__('Skal der navn på produktet?')}}</label>
                                <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end1">
                                    <div class="controls">
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="noRadio2" name="text_on_product" value="0" checked>
                                            <label for="noRadio2">{{__('No')}}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" id="yesRadio2" name="text_on_product" value="1">
                                            <label for="yesRadio2">{{__('Yes')}}</label>
                                        </div>
                                    </div>
                                </div><!-- filed group -->
                            </div><!-- Form group -->
                            <div class="row"> <!-- start 8th row  -->
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>{{__('Tilføj placering')}} </h5>
                                        <div class="controls">
                                            <select name="text_value[]" class="form-control select2" multiple >
                                                @foreach($ProductLogoPostion as $LogoPostion)
                                                <option value="{{ $LogoPostion->positions }}">{{ $LogoPostion->positions }} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> <!-- end col md 6 -->
                            </div> <!-- end 8th row  -->

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
    /*
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

});*/
</script>
<script>
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#category_ids').on('change', function(){
        var category_ids = $(this).val();
        console.log(category_ids);
        var category_idsObj = Object.assign({}, category_ids);
        var _token = $("input[name='_token']").val();
        if(category_ids) {
            $.ajax({
                url: "{{  url('/sample-product/category/subcategory/ajax') }}/",
                type:"post",
                data:{'category_ids':category_idsObj,_token:_token},
                dataType:"json",
                success:function(data) {
                    if(data){
                        console.log(data);
                        $("#subcategory_id").empty();
                        $("#subcategory_id").append('<option value="" disabled="">---- Select Subcategory---</option>');
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
