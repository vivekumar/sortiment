<?php $__env->startSection('admin'); ?>
<div class="container-full">

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-black" style="background: url('../images/gallery/full/10.jpg') center center;">
                    <h3 class="widget-user-username">Name : <?php echo e($adminData->name); ?></h3>
                    <a href="<?php echo e(route('admin.profile.edit')); ?>" class="btn btn-rounded btn-info mb-5" style="float:right">Edit Profile</a>
                    <h6 class="widget-user-desc">Email : <?php echo e($adminData->email); ?></h6>
                </div>
                <div class="widget-user-image">
                    <img class="rounded-circle" src="<?php echo e((!empty($adminData->profile_photo_path))?url('uploads/admin_images/'.$adminData->profile_photo_path): url('uploads/no_image.jpg')); ?>" alt="User Avatar">
                </div>
                <div class="box-footer">
                    <div class="row">
                    <div class="col-sm-4">
                        <div class="description-block">
                        <h5 class="description-header">12K</h5>
                        <span class="description-text">FOLLOWERS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 br-1 bl-1">
                        <div class="description-block">
                        <h5 class="description-header">550</h5>
                        <span class="description-text">FOLLOWERS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4">
                        <div class="description-block">
                        <h5 class="description-header">158</h5>
                        <span class="description-text">TWEETS</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div> 

        </div>
    </div>
</section>
<!-- /.content -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/admin/profile/profile_view.blade.php ENDPATH**/ ?>