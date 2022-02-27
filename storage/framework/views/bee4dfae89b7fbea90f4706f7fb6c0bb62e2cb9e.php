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
			  <h4 class="box-title">Company Fill </h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
                    <form method="post" action="<?php echo e(route('product.update')); ?>" enctype="multipart/form-data" >
		 	            <?php echo csrf_field(); ?>
                        <input type="hidden" name="id" value="">
                        <div class="row">
                            <div class="col-12">
                                <table class="table">
                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo e(\App\Models\User::where('id',$product->user_id)->value('name')); ?></td>

                                        <th>Company</th>
                                        <td><?php echo e(\App\Models\User::where('id',$product->user_id)->value('company')); ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-6">
                                <?php if($product->logo_on_product==1): ?>
                                    <table  class="table">
                                        <tr>
                                            <th>Logo on the product</th>
                                            <td><?php if($product->logo_on_product==1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                        </tr>
                                    </table>
                                    <div style="text-align:center; font-weight:bold">
                                        <?php if(!empty($product->logo_front_left)): ?> <?php echo e($product->logo_front_left); ?>, <?php endif; ?>
                                        <?php if(!empty($product->logo_front_right)): ?><?php echo e($product->logo_front_right); ?>, <?php endif; ?>
                                        <?php if(!empty($product->logo_shoulder_left)): ?><?php echo e($product->logo_shoulder_left); ?>,<?php endif; ?>
                                        <?php if(!empty($product->logo_shoulder_right)): ?><?php echo e($product->logo_shoulder_right); ?>, <?php endif; ?>
                                        <?php if(!empty($product->logo_onthe_back_side)): ?><?php echo e($product->logo_onthe_back_side); ?>, <?php endif; ?>
                                    </div>
                                    
                                <?php endif; ?>
                            </div>
                            <div class="col-6">
                                <?php if($product->text_on_product==1): ?>
                                    <table  class="table">
                                        <tr>
                                            <th>Text on the product</th>
                                            <td><?php if($product->text_on_product==1): ?> Yes <?php else: ?> No <?php endif; ?></td>
                                        </tr>
                                    </table>
                                    <div style="text-align:center; font-weight:bold"><?php if(!empty($product->text_front_left)): ?> <?php echo e($product->text_front_left); ?>, <?php endif; ?>
                                    <?php if(!empty($product->text_front_right)): ?><?php echo e($product->text_front_right); ?>, <?php endif; ?>
                                    <?php if(!empty($product->text_shoulder_left)): ?><?php echo e($product->text_shoulder_left); ?>, <?php endif; ?>
                                    <?php if(!empty($product->text_shoulder_right)): ?><?php echo e($product->text_shoulder_right); ?>, <?php endif; ?>
                                    <?php if(!empty($product->text_onthe_back_side)): ?><?php echo e($product->text_onthe_back_side); ?>, <?php endif; ?>
                                    </div>
                                    
                                <?php endif; ?>
                            </div>

                            <div class="col-12">
                            <hr />
                                <p>Description</p>
                                <?php echo e($product->message); ?>

                            </div>
                            <div class="col-12">
                            <hr />
                                <p>Click on Logo to Download Image</p>
                                <a href="<?php echo e(asset($product->logo)); ?>" download><img src="<?php echo e(asset($product->logo)); ?>" style="max-width:300px" height="auto" width="auto"></a>
                            </div>
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
         <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">Product Detail </h4>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
                    

                    <div class="row">
                    <div class="col-4">
                           <img src="<?php echo e(asset($product->product->product_thambnail)); ?>" style="max-width:auto" height="auto" width="auto">
                        </div>
                        <div class="col-8">
                            <h2><?php echo e($product->product->product_name); ?></h2>
                            <h4>Price : <?php echo e($product->product->product_price); ?> SKU : <?php echo e($product->product->product_sku); ?></h4>
                            <h4>Brand :
                            <?php echo e(\App\Models\Brand::where('id',$product->product->brand_id)->value('brand_name')); ?></h4>
                            <h4>Category : <?php echo e(\App\Models\Category::where('id',$product->product->category_id)->value('category_name')); ?></h4>
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
		</section>








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

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/backend/price_request/edit.blade.php ENDPATH**/ ?>