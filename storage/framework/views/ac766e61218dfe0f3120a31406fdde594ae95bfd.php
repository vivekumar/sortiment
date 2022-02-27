<?php $__env->startSection('content'); ?>
<div class="order-history-wrap shadow-box">
    <div class="order-head d-flex align-items-center justify-content-between">
        <h3><i class="fas fa-receipt"></i> <?php echo e(__('Order history')); ?></h3>
        <p><?php echo e(__('Number of orders')); ?>: #<?php echo e(count($orders)); ?></p>
    </div><!-- Order head -->
    <div class="table-content">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th><?php echo e(__('Order number')); ?></th>
                        <th><?php echo e(__('Products')); ?></th>
                        <th><?php echo e(__('Quantity')); ?></th>
                        <th><?php echo e(__('Total')); ?></th>
                        <th><?php echo e(__('Status')); ?></th>
                        <th><?php echo e(__('Action')); ?></th>
                    </tr>
                </thead>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $orderItems=DB::table('order_items')->where('order_id',$order->id)->get();
                ?>
                <tr>
                    <td>
                        <strong>Order: #<?php echo e($order->order_number); ?></strong>
                    </td>
                    <td>
                        <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e(\App\Models\CustomizeProduct::where('id',$orderItem->product_id)->value('product_name')); ?> </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </td>
                    <td>
                        <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div><?php echo e($orderItem->qty); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </td>
                    <td><?php echo e($order->amount); ?></td>
                    <td>
                        <span class="btn btn-status <?php if($order->status=='Completed'): ?> <?php echo e('blue'); ?> <?php endif; ?>"><?php echo e(__($order->status)); ?></span>
                    </td>
                    <td>
                        <div class="actions">
                            <a href="<?php echo e(route('order.details',$order->id)); ?>"><i class="fas fa-eye"></i></a>
                            <?php if($order->status=='Completed'): ?>
                            <a href="#"><i class="fas fa-file-pdf"></i></a>
                            <a href="#"><i class="fas fa-shopping-cart"></i></a>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </table>
        </div><!-- table details -->
    </div>
</div><!-- Order History -->

<div class="modal fade" id="viewModal_order" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="excelModalLabel"><strong>
        <?php echo e(__('Import employees using Execel')); ?></strong></h5>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form action="" class="price-form">

                <div class="company-info">
                    <div class="form-group mb-3 upload-logo">
                        <button type="button" id="btnup" class="upload-btn">
                            <p id="namefile" class=""><?php echo e(__('Upload a file')); ?></p>
                            <img src="assets/img/upload-icon.png" class="upload-icon" alt="">
                        </button>
                        <input type="file" value="" name="fileup" id="fileup">
                    </div><!-- row-->

                    <div class="form-group">
                        <button type="submit" class="btn btn-blue f-width"><?php echo e(__('Upload Excel file')); ?></button>
                    </div>
                </div>
            </form><!-- Price form-->
        </div>
    </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/company/order-history.blade.php ENDPATH**/ ?>