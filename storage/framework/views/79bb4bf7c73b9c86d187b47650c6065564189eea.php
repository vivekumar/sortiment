<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('backend/assets/vendors/select2/dist/css/select2.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('backend/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('admin'); ?>


	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Add Product </h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
                    <form method="post" action="<?php echo e(route('cproduct.update')); ?>" enctype="multipart/form-data" >
		 	            <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                        <div class="row">
                            <div class="col-12">

                                <div class="row"> <!-- start 1nd row  -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Product Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="product_name" value="<?php echo e($product->product_name); ?>" class="form-control">
                                                <?php $__errorArgs = ['product_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="text-danger"><?php echo e($message); ?></span>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Category Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="category_id" class="form-control select2"  require>
                                                    <option value="" selected="" disabled="">Select Category</option>
                                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>" <?php if($category->id==$product->category_id): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e($category->category_name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                                <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>

                                    </div> <!-- end col md 4 -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select name="subcategory_id" class="form-control" class="subcategory_id" id="subcategory_id">
                                                    <option value="" selected="" disabled="">Select SubCategory</option>
                                                </select>
                                                <?php $__errorArgs = ['subcategory_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-danger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div> <!-- end col md 4 -->
                                </div> <!-- end 1nd row  -->


                                <div class="row"> <!-- start 5th row  -->
                                    <div class="col-md-8">
                                        <div class="row"> <!-- start 3RD row  -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Brand Select <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="brand_id" class="form-control select2"  >
                                                            <option value="" selected="" disabled="">Select Brand</option>
                                                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($brand->id); ?>" <?php if($brand->id==$product->brand_id): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e($brand->brand_name); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                        <?php $__errorArgs = ['brand_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <span class="text-danger"><?php echo e($message); ?></span>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product SKU <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_sku" value="<?php echo e($product->product_sku); ?>" class="form-control" require>
                                                        <?php $__errorArgs = ['product_sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                        </div> <!-- end 3RD row  -->

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Product Price <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <input type="text" name="product_price" value="<?php echo e($product->product_price); ?>" class="form-control" require>
                                                        <?php $__errorArgs = ['product_price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>Company <span class="text-danger">*</span></h5>
                                                    <div class="controls">
                                                        <select name="user_id" class="form-control select2"  >
                                                            <option value="" selected="" disabled="">Select Company</option>
                                                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($user->id); ?>" <?php if($user->id==$product->user_id): ?><?php echo e('selected'); ?><?php endif; ?>><?php echo e($user->company); ?> (<?php echo e($user->name); ?>)</option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 4 -->
                                        </div>


                                        <div class="row"> <!-- start 8th row  -->
                                            <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $product_attrval= \App\Models\CustomizeProductAttribute::where(['product_id' => $product->id,'attribute_id'=>$attribute->id])->get();
                                            foreach($product_attrval as $product_attrvals){
                                                $array_product_attrvalues[]=$product_attrvals->attrvalue_id;
                                            }
                                            ?>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <h5><?php echo e($attribute->attr_name); ?> <span class="text-danger">*</span></h5>
                                                    <input type="hidden" value="<?php echo e($attribute->id); ?>" name="attr_id[]">
                                                    <div class="controls">
                                                        <select name="attrval_id[<?php echo e($attribute->id); ?>][]" class="form-control select2" multiple >
                                                            <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                            

                                                            

                                                            <option value="<?php echo e($value->id); ?>" <?php if(in_array($value->id,$array_product_attrvalues)): ?> selected <?php endif; ?>><?php echo e($value->attr_value); ?> </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div> <!-- end col md 6 -->
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div> <!-- end 8th row  -->
                                    </div>
                                    <div class="col-md-4">
                                        <table class="table">
                                            <thead>
                                                <th>Qty</th>
                                                <th>Price</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><input class="form-control" type="text" value="0" readonly name="qty1"></td>
                                                    <td>
                                                        <input class="form-control" type="number" value="<?php echo e($product->price1); ?>" name="price1">
                                                        <?php $__errorArgs = ['price1'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" value="10" readonly name="qty2"></td>
                                                    <td>
                                                        <input class="form-control" type="number" value="<?php echo e($product->price2); ?>" name="price2">
                                                        <?php $__errorArgs = ['price2'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" value="25" readonly name="qty3"></td>
                                                    <td>
                                                        <input class="form-control" type="number" value="<?php echo e($product->price3); ?>" name="price3">
                                                        <?php $__errorArgs = ['price3'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" value="50" readonly name="qty4"></td>
                                                    <td>
                                                        <input class="form-control" type="number" value="<?php echo e($product->price4); ?>" name="price4">
                                                        <?php $__errorArgs = ['price4'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><input class="form-control" type="text" value="100+" readonly name="qty5"></td>
                                                    <td>
                                                        <input class="form-control" type="number" value="<?php echo e($product->price5); ?>" name="price5">
                                                        <?php $__errorArgs = ['price5'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <span class="text-danger"><?php echo e($message); ?></span>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div> <!-- end 5th row  -->
                                <div class="row"> <!-- start 7th row  -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h5>Description </h5>
                                            <div class="controls">
                                                <textarea name="description" id="textarea" class="form-control textarea" placeholder="Textarea text" ><?php echo e($product->description); ?></textarea>
                                            </div>
                                        </div>
                                    </div> <!-- end col md 6 -->
                                </div> <!-- end 7th row  -->



                            </div>
                        </div>

						<div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Product">
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
                    <h4 class="box-title">Product Thambnail and PDF <strong>Update</strong></h4>
                </div>
                <div class="box-body">
                    <form method="post" action="<?php echo e(route('update-cproduct-thambnail')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                        <input type="hidden" name="old_img" value="<?php echo e($product->product_thambnail); ?>">

                        <div class="row row-sm">

                            <div class="col-md-4">
                                <img src="<?php echo e(asset($product->product_thambnail)); ?>" class="card-img-top" style="height: 130px; width: 280px;">
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                    <input type="file" name="product_thambnail" class="form-control" onChange="mainThamUrl(this)"  >
                                    <img src="" id="mainThmb">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-control-label"></label>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                                </div>
                            </div><!--  end col md 4 -->
                        </div>
                    </form>
                    <hr>
                    <form method="post" action="<?php echo e(route('update-cproduct-pdf')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                        <input type="hidden" name="old_pdf" value="<?php echo e($product->product_pdf); ?>">

                        <div class="row row-sm">

                            <div class="col-md-4">
                                <?php if(!empty($product->product_pdf)): ?>
                                <iframe src="<?php echo e(asset($product->product_pdf)); ?>" style="width:100%; height:200px;" frameborder="0"></iframe>
                                <?php else: ?>
                                    <div style="padding:50px;background:#FFF; font-weight:bold;font-size:20px;">No PDF Found</div>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="form-control-label">Change Product PDF <span class="tx-danger">*</span></label>
                                    <input type="file" name="product_pdf" class="form-control" require>
                                    <?php $__errorArgs = ['product_pdf'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-danger"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-control-label"></label>
                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update PDF">
                                </div>
                            </div><!--  end col md 4 -->
                        </div>
                    </form>

                </div>
            </div> <!-- // end row  -->
        </section>
        <!-- ///////////////// End Start Thambnail Image Update Area ///////// -->

        <!-- ///////////////// Start Multiple Image Update Area ///////// -->
        <?php if(count($multiImgs) > 0 ): ?>
        <section class="content">

            <div class="box bt-3 border-info">
                <div class="box-header">
                    <h4 class="box-title">Product Multiple Image <strong>Update</strong></h4>
                </div>
                <div class="box-body">
                    <form method="post" action="<?php echo e(route('update-cproduct-image')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row row-sm">
                            <?php $__currentLoopData = $multiImgs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-3">
                                <div class="card">
                                    <img src="<?php echo e(asset($img->photo_name)); ?>" class="card-img-top" style="height: 130px; width: 280px;">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <a href="<?php echo e(route('product.multiimg.delete',$img->id)); ?>" class="btn btn-sm btn-danger" id="delete" title="Delete Data"><i class="fa fa-trash"></i> </a>
                                        </h5>
                                        <p class="card-text">
                                            <div class="form-group">
                                                <label class="form-control-label">Change Image <span class="tx-danger">*</span></label>
                                                <input class="form-control" type="file" name="multi_img[<?php echo e($img->id); ?>]">
                                            </div>
                                        </p>
                                    </div>
                                </div>
                            </div><!--  end col md 3		 -->
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                        </div>
                        <br><br>
                    </form>
                </div>
            </div> <!-- // end row  -->
        </section>
        <?php endif; ?>
        <!-- ///////////////// Start Thambnail Image Update Area ///////// -->


        <section class="content">

            <div class="box bt-3 border-info">
                <div class="box-header">
                    <h4 class="box-title">Add New Product Multiple Image <strong>Update</strong></h4>
                </div>
                <div class="box-body">
                    <form method="post" action="<?php echo e(route('insert-cproduct-image')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="<?php echo e($product->id); ?>">
                        <div class="row row-sm">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="form-control-label">Upload Multiple Image <span class="tx-danger">*</span></label>
                                    <input type="file" name="multi_img[]" class="form-control"  multiple="" id="multiImg"   >
                                </div>

                            </div><!--  end col md 3		 -->

                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update Image">
                        </div>
                        <br><br>
                    </form>
                </div>
            </div> <!-- // end row  -->
        </section>
        <!-- ///////////////// Start Thambnail Image Update Area ///////// -->








		<!-- /.content -->
	  </div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<!-- /// Tgas Input Script -->
<script src="<?php echo e(asset('./assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js')); ?>"></script>
<script src="<?php echo e(asset('./assets/vendor_components/select2/dist/js/select2.full.js')); ?>"></script>
<!-- // CK EDITOR  -->
 <script src="<?php echo e(asset('./assets/vendor_components/ckeditor/ckeditor.js')); ?>"></script>
 <script src="<?php echo e(asset('./assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js')); ?>"></script>

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
    var child_cateid=<?php echo e($product->subcategory_id); ?>;
    $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id) {
            $.ajax({
                url: "<?php echo e(url('/category/subcategory/ajax')); ?>/"+category_id,
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

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/backend/customize_product/edit.blade.php ENDPATH**/ ?>