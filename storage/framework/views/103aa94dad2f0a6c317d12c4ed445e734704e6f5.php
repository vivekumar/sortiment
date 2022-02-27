<?php $__env->startSection('admin'); ?>

<style>
    /*PRELOADING------------ */
div#exampleModal .modal-dialog {
 margin-top: 8%;
}
</style>
<!-- Button trigger modal -->
<div id="overlayer" style="display:none"></div>
<span class="loader" style="display:none">
  <span class="loader-inner"></span>
</span>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Upload Excel file')); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" class="product-form">
            <?php echo csrf_field(); ?>
            <div id="errors"></div>
            <div class="company-info">
                <div class="form-group mb-3 upload-logo">
                    <!--<button type="button" id="btnup" class="upload-btn">
                        <p id="namefile" class="">Upload a file</p>
                        <img src="<?php echo e(asset('frontend/assets/img/upload-icon.png')); ?>" class="upload-icon" alt="">
                    </button>-->
                    <input type="file" value="" name="fileup" id="fileup">
                </div><!-- row-->
                <div id="responseMsg" ></div>
                <div class='alert alert-danger mt-2 d-none text-danger1' id="err_file"></div>
                <!--<div class="form-group">
                    <button type="button" id="submit" class="btn btn-blue f-width">Upload Excel file</button>
                </div>-->
            </div>
        </form><!-- Price form-->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="submit" class="btn btn-info"><?php echo e(__('Upload')); ?></button>
      </div>
    </div>
  </div>
</div>


  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">
		  <div class="row">



			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title"><?php echo e(__('Product list')); ?></h3>

                  <form method="get" class="pull-right" id="comform" action="">
                      <select name="user_id" class="select2 pull-left ml-20 mr-15" onchange="submitfilter()">
                        <option value="" selected="" disabled=""><?php echo e(__('Select company')); ?></option>
                          <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($user->id); ?>" <?php if(isset($_GET['user_id']) && $_GET['user_id']==$user->id): ?> selected <?php endif; ?>><?php echo e($user->company); ?> (<?php echo e($user->name); ?>)</option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                      <select class="select2 pull-left ml-20 mr-15" name="status" onchange="submitfilter()">
                            <option value=""><?php echo e(__('Choose status')); ?></option>
                            <option value="pending" <?php if(isset($_GET['status']) && $_GET['status']=='pending'): ?> selected <?php endif; ?>><?php echo e(__('Pending')); ?></option>
                            <option value="approved" <?php if(isset($_GET['status']) && $_GET['status']=='approved'): ?> selected <?php endif; ?>><?php echo e(__('Approved')); ?></option>
                            <option value="ordered" <?php if(isset($_GET['status']) && $_GET['status']=='ordered'): ?> selected <?php endif; ?>><?php echo e(__('Ordered')); ?></option>
                            <option value="denied" <?php if(isset($_GET['status']) && $_GET['status']=='denied'): ?> selected <?php endif; ?>><?php echo e(__('Denied')); ?></option>
                        </select>
                  </form>
                  <button type="button" class="btn btn-info pull-right ml-15 mr-15" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-upload fa-1x" aria-hidden="true"></i> <?php echo e(__('Upload product')); ?></button>
                  <a href="<?php echo e(url('/')); ?>/public/uploads/excel/customize-sample-product.xlsx" class="btn btn-primary pull-right" download><i class="fa fa-download fa-1x" aria-hidden="true"></i> <?php echo e(__('Sample file')); ?></a>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
                                <th><?php echo e(__('Image')); ?> </th>
								<th><?php echo e(__('Product name')); ?></th>
								<th><?php echo e(__('Price')); ?> </th>
								<th><?php echo e(__('SKU')); ?></th>
								<!--<th>Discount </th>-->
								<th><?php echo e(__('Status')); ?> </th>
								<th><?php echo e(__('Action')); ?></th>
							</tr>
						</thead>
						<tbody>
	 <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	 <tr>
		<td> <img src="<?php echo e(asset($item->product_thambnail)); ?>" style="width: 60px; height: 50px;">  </td>
		<td><?php echo e($item->product_name); ?></td>
		 <td><?php echo e($item->product_price); ?></td>
		 <td><?php echo e($item->product_sku); ?></td>
		 

		 <td>

		 	<span class="badge badge-pill badge-<?php if($item->status == 'ordered'): ?><?php echo e('primary'); ?><?php elseif($item->status == 'approved'): ?><?php echo e('success'); ?><?php elseif($item->status == 'denied'): ?><?php echo e('danger'); ?><?php else: ?><?php echo e('warning'); ?><?php endif; ?>"> <?php echo e(__(ucfirst($item->status))); ?> </span>


		 </td>

		<td width="30%">
 			<!--<a href="<?php echo e(route('cproduct.edit',$item->id)); ?>" class="btn btn-primary" title="Product Details Data"><i class="fa fa-eye"></i> </a>-->
			<a href="<?php echo e(route('cproduct.edit',$item->id)); ?>" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>
			<a href="<?php echo e(route('cproduct.delete',$item->id)); ?>" class="btn btn-danger" title="Delete Data" id="delete">
 				<i class="fa fa-trash"></i></a>
			
		</td>

	 </tr>
	  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>

					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->


			</div>
			<!-- /.col -->





		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>




<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('./assets/vendor_components/select2/dist/js/select2.full.js')); ?>"></script>
 <script>
 $(function () {
    "use strict";
    //Initialize Select2 Elements
    $('.select2').select2({selectOnClose: false});

 });
 </script>
 <script>
    function submitfilter(){
        $("form").submit();
    }
</script>

<script>
  var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

  $(document).ready(function(){

    $('#submit').click(function(){
        console.log('ewrwe');
      // Get the selected file
      var files = $('#fileup')[0].files;

      if(files.length > 0){
         var fd = new FormData();

         // Append data
         fd.append('file',files[0]);
         fd.append('_token',CSRF_TOKEN);

         // Hide alert
         $('#responseMsg').hide();

         // AJAX request
         $.ajax({
           url: "<?php echo e(route('cproduct.upload')); ?>",
           method: 'post',
           data: fd,
           contentType: false,
           processData: false,
           dataType: 'json',
           beforeSend: function() {
            $(".loader").show();
            $("#overlayer").show();
            },
           success: function(response){
            $("#errors").html('');
             // Hide error container
             $('#err_file').removeClass('d-block');
             $('#err_file').addClass('d-none');

             if(response.success == 1){ // Uploaded successfully

               // Response message
               $('#responseMsg').removeClass("alert alert-danger");
               $('#responseMsg').addClass("alert alert-success");
               $('#responseMsg').html(response.message);
               $('#responseMsg').show();

               // File preview
               $('#filepreview').show();
               $('#filepreview img,#filepreview a').hide();

                setTimeout(() => {
                    location.reload();
                }, 1000);

             }else if(response.success == 2){ // File not uploaded

               // Response message
               $('#responseMsg').removeClass("alert alert-success");
               $('#responseMsg').addClass("alert alert-danger");
               $('#responseMsg').html(response.message);
               $('#responseMsg').show();
             }else{
               // Display Error
               $('#err_file').text(response.error);
               $('#err_file').removeClass('d-none');
               $('#err_file').addClass('d-block');
             }
           },
           error: function(xhr, status, error)
            {
                $('#err_file').text('');
                $('#err_file').removeClass('d-block');
                $('#err_file').addClass('d-none');
                $.each(xhr.responseJSON.errors, function (key, item)
                {
                    $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                });
            },
           /*error: function(response){
              console.log("error : " + JSON.stringify(response) );
           }*/
         });
      }else{
         alert("Please select a file.");
      }

    });
  });
  </script>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/backend/customize_product/list.blade.php ENDPATH**/ ?>