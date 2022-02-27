<?php $__env->startSection('css'); ?>
    <link href="<?php echo e(asset('assets/vendor_components/fontawsome/css/vendor/fontawsome5.css')); ?>" rel="stylesheet" />

<?php $__env->stopSection(); ?>
<?php $__env->startSection('admin'); ?>
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo e(__('Add Sub Category')); ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form method="post" class="form subcategory" action="<?php echo e(route('subcategory.store')); ?>" novalidate>
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5><?php echo e(__('Category Name')); ?> <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control select2" required data-validation-required-message="<?php echo e(__('This field is required')); ?>">
                                                <option value="">------<?php echo e(__('Select Category')); ?>----------</option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <?php $__errorArgs = ['subcategory_name_fr'];
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
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5><?php echo e(__('SubCategory Name')); ?> <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="subcategory_name" class="form-control" required="" data-validation-required-message="<?php echo e(__('This field is required')); ?>" aria-invalid="false">
                                            <?php $__errorArgs = ['subcategory_name'];
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
            <div class="col-12">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo e(__('Sub Category List')); ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo e(__('SubCategory Name')); ?></th>
                                <th><?php echo e(__('Category')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>

                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php //print_r($cate['category']) ?>
                            <tr>
                                <td><?php echo e($cate->subcategory_name); ?></td>
                                <td><?php echo e($cate['category']['category_name']); ?></td>
                                <td><a href="<?php echo e(route('subcategory.edit',$cate->id)); ?>" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a><a href="<?php echo e(route('subcategory.delete',$cate->id)); ?>" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a></td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                </div>

            </div>

        <div>
    </section>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('./assets/icons/feather-icons/feather.min.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/pages/validation.js')); ?>"></script>
<script src="<?php echo e(asset('backend/js/pages/form-validation.js')); ?>"></script>
<script>

    $(document).ready(function(){

        $("input[type='radio']").click(function(){
            console.log('fsdf');
            var radioValue = $("input[name='group1']:checked").val();
            if(radioValue==1){
                $('form.subcategory').removeClass('hide');
                $('form.subcategory').addClass('show');
                $('form.type').removeClass('show');
                $('form.type').addClass('hide');
            }else{
                $('form.subcategory').removeClass('show');
                $('form.subcategory').addClass('hide');
                $('form.type').removeClass('hide');
                $('form.type').addClass('show');
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/backend/subcategory/view.blade.php ENDPATH**/ ?>