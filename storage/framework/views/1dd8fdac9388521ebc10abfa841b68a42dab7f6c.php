<?php $__env->startSection('admin'); ?>
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-8">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo e(__('Alle brands')); ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($brand->brand_name); ?></td>
                                <td><a href="<?php echo e(route('brand.edit',$brand->id)); ?>" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a><a href="<?php echo e(route('brand.delete',$brand->id)); ?>" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a></td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                </div>

            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo e(__('Tilføj brand')); ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="<?php echo e(route('brand.store')); ?>" >
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5><?php echo e(__('Navn på brand')); ?> <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="brand_name" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            <?php $__errorArgs = ['brand_name'];
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
                                <button type="submit" class="btn btn-rounded btn-info"><?php echo e(__('Submit')); ?></button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        <div>
    </section>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/backend/brand/view.blade.php ENDPATH**/ ?>