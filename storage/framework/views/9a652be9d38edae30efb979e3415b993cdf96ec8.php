<?php $__env->startSection('admin'); ?>
<div class="container-full">

    <section class="content">
		<div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo e(__('Edit Attribute')); ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="<?php echo e(route('attribute.update',$attribute->id)); ?>" >
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="id" value="<?php echo e($attribute->id); ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5><?php echo e(__('Attribute Name')); ?> <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="<?php echo e($attribute->attr_name); ?>" name="attr_name" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            <?php $__errorArgs = ['attr_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="text-tenger"><?php echo e($message); ?></span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info"><?php echo e(__('Update')); ?></button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        <div>
    </section>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/backend/attribute/edit.blade.php ENDPATH**/ ?>