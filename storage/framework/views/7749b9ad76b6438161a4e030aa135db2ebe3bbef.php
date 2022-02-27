<?php $__env->startSection('admin'); ?>

<div class="container-full">

        <div class="col-12">
            <div class="box">
                <div class="box-header">
                    <h4 class="box-title align-items-start flex-column">Oversigt over virksomheder</h4>
                </div>
                <?php
                $users=\App\Models\User::orderBy('id', 'desc')->get();

                ?>
                <div class="box-body">
                    <div class="table-responsive">
                    <table id="example11" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <th><?php echo e(__('Company')); ?></th>
                                <th><?php echo e(__('CRV nummer')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->company); ?></td>
                                <td><?php echo e($user->crv_number); ?></td>
                                <td>
                                <a href="<?php echo e(route('user.view',$user->id)); ?>" class="btn btn-primary" title="Product Details Data"><i class="fa fa-eye"></i> </a>
                                <?php if($user->approved_at): ?>
                                    <a href="<?php echo e(route('admin.users.unapprove',$user->id)); ?>" class="btn btn-success" title="Active"><i class="fa fa-thumbs-up"></i> </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('admin.users.approve',$user->id)); ?>" class="btn btn-danger" title="Inactive"><i class="fa fa-thumbs-down"></i> </a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('user.delete',$user->id)); ?>" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i> </a>
                                </td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>

$('#example11').dataTable({
    language: {
        url: '/public/backend/da.json',
    },
    "order": []
});
</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/admin/index.blade.php ENDPATH**/ ?>