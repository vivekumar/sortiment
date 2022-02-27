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
                        <form method="post" action="<?php echo e(route('attributeval.update',$attributevalue->id)); ?>" >
                            <?php echo csrf_field(); ?>

                            <input type="hidden" name="id" value="<?php echo e($attributevalue->id); ?>">
                            <input type="hidden" name="attr_id" value="<?php echo e($attr_id); ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5><?php echo e(__('Attribute Name')); ?> <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="<?php echo e($attributevalue->attr_value); ?>" name="attr_value" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            <?php $__errorArgs = ['attr_value'];
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
                                    <div class="form-group">
                                        <h5><?php echo e(__('Attribute Name')); ?> <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="<?php echo e($attributevalue->attr_code); ?>" name="attr_code" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            <?php $__errorArgs = ['attr_code'];
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
                                    <div class="form-group">
                                        <h5><?php echo e(__('Order')); ?> <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" value="<?php echo e($attributevalue->attr_order); ?>" name="attr_order" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            <?php $__errorArgs = ['attr_order'];
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

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/backend/attribute_value/edit.blade.php ENDPATH**/ ?>