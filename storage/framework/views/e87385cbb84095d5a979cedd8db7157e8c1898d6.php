<?php $__env->startSection('admin'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">

<!-- Main content -->
<section class="content">
<style>
    .form-horizontal .form-label {
        text-align: right;
    }
</style>
<!-- Basic Forms -->
 <div class="box">
   <div class="box-header with-border">
     <h2 class="box-title"><?php echo e(__('Default Messages')); ?></h2>
     <div class="pull-right">
       <button type="submit" class="btn btn-success" id="butoon-form" form="form-default-message" data-toggle="tooltip" title="Save">
           <i class="fa fa-save"></i>
       </button>
       <a  id="butoon-cacnel" class="btn btn-primary" href="<?php echo e(route('admin.default.message')); ?>" data-toggle="tooltip" title="Cancel">
            <i class="fa fa-reply"></i>
       </a>
     </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body">
    <form class="ibox-body form-horizontal" id="form-default-message" action="<?php echo e($form['action']); ?>" method="POST">
        <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
        <div class="mb-3 row">
            <label class="form-label col-sm-3" for="input-message"><?php echo e(__('Message')); ?></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="message" placeholder="Message" value="<?php echo e($form['message']); ?>" required>
                <?php if(!empty($form['errors']['message'])): ?>
                    <div class="text-danger"><?php echo e($form['errors']['message']); ?></div>
                <?php endif; ?>
            </div>
        </div>
        <div class="mb-3 row">
            <label class="form-label col-sm-3" for="input-link"><?php echo e(__('Link')); ?></label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="link" placeholder="Link" value="<?php echo e($form['link']); ?>">
            </div>
        </div>

        <div class="mb-3 row">
            <label class="form-label col-sm-3"><?php echo e(__('Status')); ?></label>
            <div class="col-sm-9">
                <div class="form-check form-check-inline">
                    <?php if($form['status'] == 1): ?>
                        <input id="input-status" name="status" class="form-check-input" type="checkbox" data-toggle="toggle" data-style="mr-1" checked value="1">
                        <label for="input-status" class="form-check-label"><?php echo e(__('Enabled')); ?></label>
                    <?php else: ?>
                        <input id="input-status" name="status" class="form-check-input" type="checkbox" data-toggle="toggle" data-style="mr-1" value="0">
                        <label for="input-status" class="form-check-label"><?php echo e(__('Disabled')); ?></label>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </form>
   </div>
   <!-- /.box-body -->
 </div>
 <!-- /.box -->

</section>
<!-- /.content -->
</div>
<script>
    (() => {
        let input_status = document.getElementById('input-status');
        input_status.addEventListener('change', (event) => {
            if (input_status.checked) {
                document.querySelector('label[for="input-status"]').innerHTML = 'Enabled';
                input_status.value = 1;
            } else {
                document.querySelector('label[for="input-status"]').innerHTML = 'Disabled';
                input_status.value = 0;
            }
        })
    })();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/admin/question/default_message_form.blade.php ENDPATH**/ ?>