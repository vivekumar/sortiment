@extends('admin.admin_master')
@section('css')
    <link href="{{ asset('backend/assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />
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
                    <form method="post" action="{{ route('cproduct.update') }}" enctype="multipart/form-data" >
		 	            @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="status" value="{{ $product->status }}">
                        <div class="row">
                            <div class="col-12">

                                <div class="row"> <!-- start 1nd row  -->

                                    <div class="col-md-8">
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
                                            <h5>{{__('Request price')}} </h5>
                                            <div class="controls">
                                                <select name="request_id" class="form-control select2"  require>
                                                    <option value="" selected="" disabled="">{{__('Select request')}}</option>
                                                    @foreach($PriceRequest as $ddata)
                                                    <option value="{{ $ddata->id }}" @if($ddata->id==$product->request_id) selected @endif>{{\App\Models\Product::where('id',$ddata->product_id)->value('product_name')}} ({{\App\Models\User::where('id',$ddata->user_id)->value('company')}})</option>
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
                                                    <option value="{{ $category->id }}" @if($category->id==$product->category_id){{'selected'}}@endif>{{ $category->category_name }}</option>
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


                                <div class="row"> <!-- start 5th row  -->
                                    <div class="col-md-8">
                                        <div class="row"> <!-- start 3RD row  -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Brand select')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="brand_id" class="form-control select2"  >
                                                            <option value="" selected="" disabled="">Select brand</option>
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
                                            <div class="col-md-6">
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
                                        </div> <!-- end 3RD row  -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Product price')}} <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_price" value="{{$product->product_price}}" class="form-control" require>
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
                                                            <option value="" selected="" disabled="">Select Company</option>
                                                            @foreach($users as $user)
                                                            <option value="{{ $user->id }}" @if($user->id==$product->user_id){{'selected'}}@endif>{{ $user->company }} ({{ $user->name }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                        </div>


                                        <div class="row"> <!-- start 8th row  -->
                                            @foreach($attributes as $attribute)
                                            @php
                                            $array_product_attrvalues=[];
                                            $product_attrval= \App\Models\CustomizeProductAttribute::where(['product_id' => $product->id,'attribute_id'=>$attribute->id])->get();
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

                                                            {{--@if(in_array($value->id,$array_product_attrvalues))
                                                            <option value="{{ $value->id }}" selected>{{$value->attr_value}}</option>
                                                            @else
                                                            <option value="{{ $value->id }}">{{$value->attr_value}}</option>
                                                            @endif--}}

                                                            <option value="{{ $value->id }}" @if(in_array($value->id,$array_product_attrvalues)) selected @endif>{{ $value->attr_value }} </option>

                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->
                                            @endforeach
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Name on product')}}<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="name_on_product" class="form-control" >
                                                            <option value="" selected="" disabled="">{{__('Select name on product')}}</option>
                                                            <option value="yes" @if($product->name_on_product=='yes'){{'selected'}}@endif>{{__('Yes')}}</option>
                                                            <option value="no" @if($product->name_on_product=='no'){{'selected'}}@endif>{{__('No')}}</option>
                                                        </select>
                                                        @error('name_on_product')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end 128th col  -->
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5>{{__('Select status')}}<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                    <select class="select2 pull-left ml-20 form-control" name="status" >
                                                        <option value="" disabled="">Choose status</option>
                                                        <option value="pending" @if($product->status=='pending') selected @endif>{{__('Pending')}}</option>
                                                        <option value="approved" @if($product->status=='approved') selected @endif>{{__('Approved')}}</option>
                                                        <option value="ordered" @if($product->status=='ordered') selected @endif>{{__('Ordered')}}</option>
                                                        <option value="denied" @if($product->status=='denied') selected @endif>{{__('Denied')}}</option>
                                                    </select>

                                                        @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div> <!-- end 128th col  -->

                                            <div class="col-md-4" >
                                                <div class="form-group">
                                                    <h5>{{__('Delivery from')}} <small>{{__('no of days')}}</small></h5>
                                                    <div class="controls">
                                                        <input type="number" name="delevery_days" min="1" value="{{$product->delevery_days}}" class="form-control">
                                                        @error('name_on_product')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                    <p>{{__('Ex 5 ( this no exclude no of day on checkout page)')}} </p>
                                                </div>
                                            </div> <!-- end 128th col  -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>{{__('Express delivery status')}}<span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <fieldset>
                                                            <input type="radio" id="checkbox_2" name="express_delivery_status" value="0" @if($product->express_delivery_status==0) checked @endif>
                                                            <label for="checkbox_2">{{__('Nej')}}</label>
                                                        </fieldset>
                                                        <fieldset>
                                                            <input type="radio" id="checkbox_3" name="express_delivery_status" value="1" @if($product->express_delivery_status==1) checked @endif>
                                                            <label for="checkbox_3">{{__('Ja')}}</label>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div> <!-- end 128th col  -->
                                            <div class="col-md-6 deliverystatuson" style="@if($product->express_delivery_status==0) display:none @endif">
                                                <div class="form-group">
                                                    <h5>{{__('Express delivery before')}} <small>{{__('no of days')}}</small></h5>
                                                    <div class="controls">
                                                        <input type="number" name="express_delivery_days" min="1" class="form-control" value="{{$product->express_delivery_days}}">
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
                                            </thead>
                                            <tbody>
                                             @foreach($mqtyprice as $qtyprice)
                                                <tr>
                                                    <td><input class="form-control" type="text" value="{{$qtyprice->qty}}" readonly name="qty[]"></td>
                                                    <td>
                                                        <input class="form-control" type="number" value="{{$qtyprice->price}}" name="price[]">
                                                        @error('price1')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                    <td><button class="btn btn-danger" type="button" onclick="confirm('Are you sure?') ? $(this).parent().parent().remove() : false"><i class="fa fa-minus-circle"></i></button></td>
                                                </tr>
                                                @endforeach
                                                {{--<tr>
                                                    <td><input class="form-control" type="text" value="10" readonly name="qty2"></td>
                                                    <td>
                                                        <input class="form-control" type="number" value="{{$product->price2}}" name="price2">
                                                        @error('price2')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" value="25" readonly name="qty3"></td>
                                                    <td>
                                                        <input class="form-control" type="number" value="{{$product->price3}}" name="price3">
                                                        @error('price3')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" value="50" readonly name="qty4"></td>
                                                    <td>
                                                        <input class="form-control" type="number" value="{{$product->price4}}" name="price4">
                                                        @error('price4')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" value="100+" readonly name="qty5"></td>
                                                    <td>
                                                        <input class="form-control" type="number" value="{{$product->price5}}" name="price5">
                                                        @error('price5')
                                                        <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </td>
                                                </tr>--}}
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
                    <h4 class="box-title">{{__('Product thambnail and pdf update')}}</h4>
                </div>
                <div class="box-body">
                    <form method="post" action="{{ route('update-cproduct-thambnail') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <input type="hidden" name="old_img" value="{{ $product->product_thambnail }}">

                        <div class="row row-sm">

                            <div class="col-md-4">
                                <img src="{{ asset($product->product_thambnail) }}" class="card-img-top" style="height: 130px; width: 280px;">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('Change image')}} <span class="tx-danger">*</span></label>
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
                    <form method="post" action="{{ route('update-cproduct-pdf') }}" enctype="multipart/form-data">
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
                                    <a href="{{ route('remove-cproduct-pdf',$product->id)}}" class="btn btn-rounded btn-danger mb-5">{{__('Remove PDF')}}</a>
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
                    <h4 class="box-title">{{__('Product multiple image update')}}</h4>
                </div>
                <div class="box-body">
                    <form method="post" action="{{ route('update-cproduct-image') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row row-sm">
                            @foreach($multiImgs as $img)
                            <div class="col-md-3">
                                <div class="card1">
                                    <img src="{{ asset($img->photo_name) }}" class="card-img-top" style="height: 130px; width: 280px;">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="{{ route('cproduct.multiimg.delete',$img->id) }}" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i> </a>
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
                    <h4 class="box-title">{{__('Add new product multiple image update')}} <strong></strong></h4>
                </div>
                <div class="box-body">
                    <form method="post" action="{{ route('insert-cproduct-image') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="row row-sm">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label">{{__('Upload multiple image')}} <span class="tx-danger">*</span></label>
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
    /*var child_cateid={{$product->subcategory_id}};
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
    }*/

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
