<?php $__env->startSection('content'); ?>
<style>
    .btn {
        font-size: 1rem;
        padding: 6px 13px;
    }
</style>
    <div class="products-con1 ask-qus-wrap d-flex">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Admin</th>
                    <th class="text-end">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sn => $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($sn + 1); ?> .</td>
                    <td><?php echo e($admin->name); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(url('employee/aska-question/chat', $admin->id)); ?>" class="btn btn-primary" data-toggle="tooltip" title="Ask Question">
                            <i class="fa fa-question-circle"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e('2'); ?> .</td>
                    <td><?php echo e(\App\Models\User::where('id',Auth::user()->user_id)->value('company')); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(url('employee/aska-question/chat-company', Auth::user()->user_id)); ?>" class="btn btn-primary" data-toggle="tooltip" title="Ask Question">
                            <i class="fa fa-question-circle"></i>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/employee/ask-question.blade.php ENDPATH**/ ?>