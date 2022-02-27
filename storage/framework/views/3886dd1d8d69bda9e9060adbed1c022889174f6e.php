<?php $__env->startSection('admin'); ?>
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-8">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Attribute List </h3>
                    <a href="<?php echo e(route('all.attribute',$attr_id)); ?>" class="waves-effect waves-light btn btn-info btn-circle mx-5 pull-right float-right"><span class="mdi mdi-arrow-left"></span></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Value</th>
                                <th>Code</th>
                                <th>Action</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $attributevalues; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($attribute->attr_value); ?></td>
                                <td><?php echo e($attribute->attr_code); ?></td>
                                <td><a href="<?php echo e(route('attributeval.edit',['id'=>$attribute->id,'attr_id'=>$attr_id])); ?>" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a><a href="<?php echo e(route('attributeval.delete',$attribute->id)); ?>" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a></td>

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
                        <h3 class="box-title">Add Attribute</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form method="post" action="<?php echo e(route('attributeval.store', ['attr_id' => $attr_id])); ?>" >
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="attr_id" value="<?php echo e($attr_id); ?>">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Attribute Value <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="attr_value" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
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
                                        <h5>Attribute Code <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="attr_code" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
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

                                </div>
                            </div>

                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        <div>
    </section>
</div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/backend/attribute_value/view.blade.php ENDPATH**/ ?>