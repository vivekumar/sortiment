<?php $__env->startSection('content'); ?>

<div class="view-order-wrap shadow-box">
    <div class="order-head d-flex align-items-center justify-content-between">
        <h3><i class="fas fa-receipt"></i> <?php echo e(__('Order status')); ?></h3>
        <p><?php echo e(__('Viewing order')); ?> #<?php echo e($order->order_number); ?></p>
    </div><!-- Order head -->
    <div class="status-content">
        <div class="row">
            <div class="col-md-8">
                <div class="order-status">
                    <?php $__currentLoopData = $order_process; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$orderp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="process-row d-flex align-items-center <?php if($key==0): ?> active <?php endif; ?>">
                        <span class="dot"></span>
                        <?php if($orderp->status=='Order recieved'): ?>
                        <img src="<?php echo e(asset('frontend/assets/img/clipboard-regular.png')); ?>" class="icon" alt="">
                        <?php elseif($orderp->status=='Payment confirmed'): ?>
                        <img src="<?php echo e(asset('frontend/assets/img/money-check-solid.png')); ?>" class="icon" alt="">
                        <?php elseif($orderp->status=='Order being processed'): ?>
                        <img src="<?php echo e(asset('frontend/assets/img/people-carry-solid.png')); ?>" class="icon" alt="">
                        <?php elseif($orderp->status=='Shipping order'): ?>
                        <img src="<?php echo e(asset('frontend/assets/img/shipping-fast-solid.png')); ?>" class="icon" alt="">
                        <?php else: ?>
                        <img src="<?php echo e(asset('frontend/assets/img/shipping-fast-solid.png')); ?>" class="icon" alt="">
                        <?php endif; ?>


                        <h4><?php echo e(__($orderp->status)); ?> <small><?php echo e(__($orderp->desc)); ?></small></h4>
                        <p class="date-time"><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orderp->date)
                    ->format('d. F H:i')); ?></p>
                    </div><!-- Process row-->
                    <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div><!-- Order status -->
            </div>
            <div class="col-md-4">
                <div class="order-track d-flex justify-content-end align-items-center">
                    <?php if(!empty($order->tracking_url)): ?>
                    <a href="<?php echo e($order->tracking_url); ?>" class="btn btn-blue"><?php echo e(__('Track delivery')); ?></a>
                    <?php endif; ?>
                    <?php if(!empty($order->pdf)): ?>
                    
                    <a href="<?php echo e(asset($order->pdf)); ?>" class="btn btn-blue" download><i class="fas fa-file-pdf"></i></a>
                    <?php endif; ?>

                </div>
                <div class="order-decs">

                    <?php
                        $orderItems=DB::table('order_items')->where('order_id',$order->id)->get();
                    ?>
                    <?php $__currentLoopData = $orderItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <figure class="product-pic">
                            <img src="<?php echo e(asset(\App\Models\CustomizeProduct::where('id',$orderItem->product_id)->value('product_thambnail'))); ?>" width="250" alt="">
                        </figure>

                        <h5><?php echo e($orderItem->product_name); ?> </h5>
                        <p><strong><?php echo e($orderItem->qty); ?> stk.</strong></p>
                        <?php
                            $orderItemsAttr=DB::table('order_item_attrs')->where('order_item_id',$orderItem->id)->get();
                        ?>
                        <?php $__currentLoopData = $orderItemsAttr; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $orderAttr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p><strong><?php echo e(__(\App\Models\Attribute::where('id',$orderAttr->attribute_id)->value('attr_name'))); ?>:</strong> <?php echo e($orderAttr->attribute_value); ?></p>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="order-block">
                            <h6><?php echo e(__('Estimated delivery date')); ?>:</h6>
                            <p><?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $orderItem->estimated_delivery_date)
                        ->format('d. F')); ?></p>
                        </div>
                        <hr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <p class="total-cost"><span><?php echo e(__('Delivery costs')); ?>: </span> <?php echo e($order->delivery_costs); ?> DKK</p>
                    <div class="order-block">
                        <h6><?php echo e(__('Total costs')); ?>: <?php echo e($order->amount+$order->delivery_costs); ?> DKK</h6>
                    </div>
                    <div class="order-block">
                        <h6><?php echo e(__('Delivery address')); ?>:</h6>
                        <p><?php echo e($order->address); ?></p>
                    </div>

                </div><!-- order descriptions -->
            </div>
        </div><!-- Row -->
    </div><!-- Status content -->
</div><!-- Order status -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/company/view-order.blade.php ENDPATH**/ ?>