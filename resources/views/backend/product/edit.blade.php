@extends('admin.admin_master')
@section('css')
    <link href="{{ asset('backend/assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
@endsection

@section('admin')
@php //print_r($selectedCategory) ; @endphp

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
                    <form method="post" action="{{ route('product.update') }}" enctype="multipart/form-data" >
		 	            @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="row">
                            <div class="col-12">

                                <div class="row"> <!-- start 1nd row  -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>{{__('Product name')}} <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="product_name" value="{{$product->product_name}}" class="form-control">
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
                                                    <option value=""  disabled="">{{__('Select category')}}</option>
                                                    @foreach($categories as $category)
                                                    @php $selected = in_array($category->id,$ProductCategory) ? "selected" : ""; @endphp
                                                    <option value="{{ $category->id }}" 
                                                       {{$selected}}
                                                    >{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_ids')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                            </div>
                                        </div>

                                    </div> <!-- end col md 4 -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>{{__('SubCategory Select')}} <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="subcategory_ids[]" class="form-control select2" multiple id="subcategory_id">
                                                    <option value=""  disabled="">{{__('Select SubCategory')}}</option>
                                                    @foreach($subCategories as $subcategory)
                                                    @php $selected = in_array($subcategory->id,$ProductSubCategory) ? "selected" : ""; @endphp
                                                    <option value="{{ $subcategory->id }}" 
                                                       {{$selected}}
                                                    >{{ $subcategory->subcategory_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('subcategory_ids')
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
                                                    <option value="" selected="" disabled="">{{__('Select brand')}}</option>
                                                    @foreach($brands as $brand)
                                                    <option value="{{ $brand->id }}" @if($brand->id==$product->brand_id){{'selected'}}@endif>{{ $brand->brand_name }}</option>
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
                                                <input type="text" name="product_sku" value="{{$product->product_sku}}" class="form-control" require>
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
                                                <input type="text" name="product_price" value="{{$product->product_price}}" class="form-control" require>
                                                @error('product_price')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->
                                </div> <!-- end 3RD row  -->



                                <div class="row"> <!-- start 8th row  -->
                                    @foreach($attributes as $attribute)
                                    @php
                                    $array_product_attrvalues=[];
                                    $product_attrval= \App\Models\ProductAttribute::where(['product_id' => $product->id,'attribute_id'=>$attribute->id])->get();
                                    foreach($product_attrval as $product_attrvals){
                                        $array_product_attrvalues[]=$product_attrvals->attrvalue_id;
                                    }
                                    @endphp

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>{{__($attribute->attr_name)}} </h5>
                                            <input type="hidden" value="{{$attribute->id}}" name="attr_id[]">
                                            <div class="controls">
                                                <select name="attrval_id[{{$attribute->id}}][]" class="form-control select2" multiple >
                                                    @foreach($attribute->values as $key=>$value)

                                                    {{--$product_attrval[$key]->attrvalue_id--}}

                                                    @if(!empty($array_product_attrvalues))
                                                        <option value="{{ $value->id }}" @if(in_array($value->id,$array_product_attrvalues)) selected @endif>{{ $value->attr_value }} </option>
                                                    @else
                                                        <option value="{{ $value->id }}">{{$value->attr_value}}</option>
                                                    @endif


                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div> <!-- end col md 6 -->
                                    @endforeach
                                </div> <!-- end 8th row  -->
                                <div class="row form-group">
                                    <label for="" class="col-md-6 col-sm-12 col-form-label">Do you want your logo on the product?</label>
                                    <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end1">
                                        <div class="controls">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="noRadio" name="logo_on_product" value="0" @if($product->logo_on_product==0){{'checked'}}@endif>
                                                <label for="noRadio">{{__('No')}}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="yesRadio" name="logo_on_product" value="1" @if($product->logo_on_product==1){{'checked'}}@endif>
                                                <label for="yesRadio">{{__('Yes')}}</label>
                                            </div>
                                        </div>
                                    </div><!-- filed group -->
                                </div><!-- Form group -->
                                <div class="row"> <!-- start 8th row  -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>{{__('Logo on the product')}} </h5>
                                            <div class="controls">
                                                <select name="logo_value[]" class="form-control select2" multiple >
                                                    @php $arraylogoposition=explode('|',$product->logo_value); @endphp
                                                    @foreach($ProductLogoPostion as $LogoPostion)
                                                    <option value="{{ $LogoPostion->positions }}" @if(in_array($LogoPostion->positions,$arraylogoposition)) selected @endif>{{ $LogoPostion->positions }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div> <!-- end col md 6 -->
                                </div> <!-- end 8th row  -->
                                <div class="row form-group">
                                    <label for="" class="col-md-6 col-sm-12 col-form-label">Do you want to assign a text to the product?</label>
                                    <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end1">
                                        <div class="controls">
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="noRadio2" name="text_on_product" value="0" @if($product->text_on_product==0){{'checked'}}@endif>
                                                <label for="noRadio2">{{__('No')}}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input type="radio" id="yesRadio2" name="text_on_product" value="1" @if($product->text_on_product==1){{'checked'}}@endif>
                                                <label for="yesRadio2">{{__('Yes')}}</label>
                                            </div>
                                        </div>
                                    </div><!-- filed group -->
                                </div><!-- Form group -->
                                <div class="row"> <!-- start 8th row  -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>{{__('Text on the product')}} </h5>
                                            <div class="controls">
                                                <select name="text_value[]" class="form-control select2" multiple >
                                                    @php $arraytextposition=explode('|',$product->text_value); @endphp
                                                    @foreach($ProductLogoPostion as $LogoPostion)
                                                    <option value="{{ $LogoPostion->positions }}" @if(in_array($LogoPostion->positions,$arraytextposition)) selected @endif>{{ $LogoPostion->positions }} </option>
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
                                                <textarea name="description" id="textarea" class="form-control textarea" placeholder="Textarea text" >{{$product->description}}</textarea>
                                            </div>
                                        </div>
                                    </div> <!-- end col md 6 -->
                                </div> <!-- end 7th row  -->
                                <div class="row"> <!-- start 8th row  -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>{{__('Meta title')}} </h5>
                                        <div class="controls">
                                            <input type="text" name="meta_title" value="{{$product->meta_title}}" class="form-control">
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
                                            <input type="text" name="meta_desc" value="{{$product->meta_desc}}" class="form-control">
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
                                            <input type="text" name="meta_tag" value="{{$product->meta_tag}}" class="form-control">
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
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="{{__('Update product')}}">
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

        <!-- /////////////////  Start Thambnail Image Update Area ///////// -->

        <section class="content">

            <div class="box bt-3 border-info">
                <div class="box-header">
                    <h4 class="box-title">{{__('Product thambnail and pdf update')}} </h4>
                </div>
                <div class="box-body">
                    <form method="post" action="{{ route('update-product-thambnail') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="old_img" value="{{ $product->product_thambnail }}">

                        <div class="row row-sm">

                            <div class="col-md-4">
                                <img src="{{ asset($product->product_thambnail) }}" class="card-img-top" style="height: 130px; width: 280px;">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('Change Image')}} <span class="tx-danger">*</span></label>
                                    <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)"  >
                                    <img src="" id="mainThmb">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-control-label"></label>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="{{__('Update image')}}">
                                </div>
                            </div><!--  end col md 4 -->
                        </div>
                    </form>
                    <hr>
                    <form method="post" action="{{ route('update-product-pdf') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="old_pdf" value="{{ $product->product_pdf }}">

                        <div class="row row-sm">

                            <div class="col-md-4">
                                @if(!empty($product->product_pdf))
                                <iframe src="{{ asset($product->product_pdf) }}" style="width:100%; height:200px;" frameborder="0"></iframe>
                                @else
                                    <div style="padding:50px;background:#FFF; font-weight:bold;font-size:20px;">No PDF Found</div>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('Change Product PDF')}} <span class="tx-danger">*</span></label>
                                    <input type="file" name="product_pdf" class="form-control" require>
                                    @error('product_pdf')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-control-label"></label>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="{{__('Update PDF')}}">
                                    <a href="{{ route('remove-product-pdf',$product->id)}}" class="btn btn-rounded btn-danger mb-5">{{__('Remove PDF')}}</a>
                                </div>
                            </div><!--  end col md 4 -->
                        </div>
                    </form>
                </div>
            </div> <!-- // end row  -->
        </section>
        <!-- ///////////////// End Start Thambnail Image Update Area ///////// -->

        <!-- ///////////////// Start Multiple Image Update Area ///////// -->
        @if(count($multiImgs) > 0 )
        <section class="content">

            <div class="box bt-3 border-info">
                <div class="box-header">
                    <h4 class="box-title">{{__('Product multiple image update')}} </h4>
                </div>
                <div class="box-body">
                    <form method="post" action="{{ route('update-product-image') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm">
                            @foreach($multiImgs as $img)
                            <div class="col-md-3">
                                <div class="card1">
                                    <img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height: 130px; width: 280px;">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('product.multiimg.delete',$img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i> </a>
                                        </h5>
                                        <p class="card-text">
                                            <div class="form-group">
                                                <label class="form-control-label">{{__('Change image')}} <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="multi_img[{{ $img->id }}]">
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div><!--  end col md 3		 -->
                            @endforeach
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="{{__('Update image')}}">
                        </div>
                        <br><br>
                    </form>
                </div>
            </div> <!-- // end row  -->
        </section>
        @endif
        <!-- ///////////////// Start Thambnail Image Update Area ///////// -->


        <section class="content">

            <div class="box bt-3 border-info">
                <div class="box-header">
                    <h4 class="box-title">{{__('Add new product multiple image update')}}</h4>
                </div>
                <div class="box-body">
                    <form method="post" action="{{ route('insert-product-image') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="row row-sm">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('Upload Multiple Image')}} <span class="tx-danger">*</span></label>
                                    <input type="file" name="multi_img[]" class="form-control"  multiple="" id="multiImg"   >
                                </div>

                            </div><!--  end col md 3		 -->

                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="{{__('Update image')}}">
                        </div>
                        <br><br>
                    </form>
                </div>
            </div> <!-- // end row  -->
        </section>
        <!-- ///////////////// Start Thambnail Image Update Area ///////// -->








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
   
    var child_cateid='{{$product->subcategory_id}}';
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
    if(child_cateid!=null){
        //$('select[name="category_id"]').change();
    }
});
</script>

@endsection
