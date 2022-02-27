<?php $__env->startSection('admin'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">

<!-- Main content -->
<section class="content">

<!-- Basic Forms -->
 <div class="box">
   <div class="box-header with-border">
     <h4 class="box-title">Admin Change Password</h4>
     
   </div>
   <!-- /.box-header -->
   <div class="box-body">
     <div class="row">
       <div class="col">
           <form method="post" action="<?php echo e(route('update.change.password')); ?>" enctype="multipart/form-data">
           <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <h5>Old Password <span class="text-danger">*</span></h5>
                        <div class="controls">
							<input type="password" id="current_password" name="oldpassword" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false"> 
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <h5>New Password <span class="text-danger">*</span></h5>
                        <div class="controls">
							<input type="password" id="password" name="password" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false"> 
                            <div class="help-block"></div>
                        </div>
                    </div>
                    <div class="form-group">
                       <h5>Confirm Password <span class="text-danger">*</span></h5>
                       <div class="controls">
                            <input type="password" id="password_confirmation" name="password_confirmation" data-validation-match-match="password" class="form-control" required=""> 
                            <div class="help-block"></div>
                        </div>
                   </div>



                </div>
              </div>
             
               
               <div class="text-xs-right">
                   <button type="submit" class="btn btn-rounded btn-info">Submit</button>
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
<script>
$(document).ready(function(){
    $('#image').change(function(e){
        var reader = new FileReader();
        reader.onload=function(e){
            $('#showImage').attr('src',e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    })
})
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/admin/profile/change_password.blade.php ENDPATH**/ ?>