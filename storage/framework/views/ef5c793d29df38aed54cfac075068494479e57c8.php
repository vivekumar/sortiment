<?php $__env->startSection('admin'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">

<!-- Main content -->
<section class="content">

<!-- Basic Forms -->
 <div class="box">
   <div class="box-header with-border">
     <h4 class="box-title">Admin Profile Edit</h4>

   </div>
   <!-- /.box-header -->
   <div class="box-body">
     <div class="row">
       <div class="col">
           <form method="post" action="<?php echo e(route('admin.profile.store')); ?>" enctype="multipart/form-data">
           <?php echo csrf_field(); ?>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <h5>User Name <span class="text-danger">*</span></h5>
                        <div class="controls">
                            <input type="text" class="form-control" name="name" value="<?php echo e($editData->name); ?>" required="" data-validation-required-message="This field is required" aria-invalid="false">
                            <div class="help-block"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                       <h5>Email Field <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="email" name="email" value="<?php echo e($editData->email); ?>" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div></div>
                   </div>
                </div>
              </div>
             <div class="row">
               <div class="col-6">
                   <div class="form-group">
                       <h5>Profile Image <span class="text-danger">*</span></h5>
                       <div class="controls">
                           <input type="file" id="image" name="profile_photo_path" class="form-control" required=""> <div class="help-block"></div></div>
                   </div>
               </div>
                <div class="col-md-6">
                    <img id="showImage" src="<?php echo e((!empty($editData->profile_photo_path))?url('uploads/admin_images/'.$editData->profile_photo_path): url('public/uploads/no_image.jpg')); ?>" height="100px">
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

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/admin/profile/profile_edit.blade.php ENDPATH**/ ?>