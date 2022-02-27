<?php $__env->startSection('admin'); ?>
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-12">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo e(__('Employee List')); ?></h3>
                    <form method="get" class="pull-right" id="comform">
                      <select name="company" class="select2 pull-left ml-20" onchange='submitForm();'>
                      <option value="" selected="" disabled=""><?php echo e(__('Select company')); ?></option>
                          <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($user->id); ?>" <?php if(isset($_GET['company']) && $_GET['company']==$user->id): ?> selected <?php endif; ?>><?php echo e($user->company); ?> (<?php echo e($user->name); ?>)</option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <th><?php echo e(__('Company')); ?></th>
                                <!--<th>Action</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($employee->name); ?></td>
                                <td><?php echo e($employee->email); ?></td>
                                <td><?php echo e($employee->company); ?></td>
                                <!--<td><a href="" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a><a href="" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a></td>-->

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                </div>

            </div>
            <!--<div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Category</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="" >
                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="category_name_en" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            <?php $__errorArgs = ['category_name_en'];
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
                                        <h5>Email </h5>
                                        <div class="controls">
                                            <input type="text"  name="category_name_de" class="form-control">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <h5>Category Icon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="cagegory_icon" class="form-control">
                                            <?php $__errorArgs = ['cagegory_icon'];
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
            </div>-->
        <div>
    </section>
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
function submitForm(){
        $("form").submit();
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/backend/employee/view.blade.php ENDPATH**/ ?>