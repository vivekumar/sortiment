<?php $__env->startSection('admin'); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="container-full">

<!-- Main content -->
<section class="content">
<!-- Basic Forms -->
 <div class="box">
   <div class="box-header with-border">
     <h2 class="box-title">Default Messages</h2>
     <div class="pull-right">
       <a href="<?php echo e(url('admin/default-message/add')); ?>" class="btn btn-primary" data-toggle="tooltip" title="Add New Default Message">
        <i class="fa fa-plus-circle"></i>
      </a>
     </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body">    
     <table class="table table-bordered table-hover">
       <thead>
         <tr>
           <th>S.No.</th>
           <th>Message</th>
           <th>Link</th>
           <th>Status</th>
           <th class="text-right">Action</th>
         </tr>
       </thead>
       <tbody>
        <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sn => $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <tr>
            <td><?php echo e($sn + 1); ?>.</td>
            <td><?php echo e($message->message); ?></td>
            <td><?php echo e($message->link); ?></td>
            <td><?php echo e($message->status == 1 ? 'Enabled' : 'Disabled'); ?></td>
            <td class="text-right">
              <a href="<?php echo e(url('admin/default-message/edit', $message->id)); ?>" class="btn btn-primary" data-toggle="tooltip" title="Edit">
                <i class="fa fa-edit"></i>
              </a>
              <a href="<?php echo e(url('admin/default-message/delete', $message->id)); ?>" onclick="return confirm('Are you sure?');" class="btn btn-danger" data-toggle="tooltip" title="Delete">
                <i class="fa fa-trash"></i>
              </a>
            </td>
          </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       </tbody>
     </table>
   </div>
   <!-- /.box-body -->
 </div>
 <!-- /.box -->

</section>
<!-- /.content -->
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/admin/question/default_message.blade.php ENDPATH**/ ?>