<?php $__env->startSection('content'); ?>
<div class="welcom-popup shadow-box text-center">
    <a href="#" class="round-btn" onClick="$(this).parent().remove()"><i class="bi bi-x-lg"></i></a>
    <h1><?php echo e(__('Welcome to your products')); ?></h1>
    <p><?php echo e(__('Your company has created a product on our page. Please fill out all the information about the product of each product below.')); ?></p>
</div><!-- Welcom popup -->
<section class="product-filter-sec ptb-45">
    <div class="filters">
        <form action="" method="get" class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select name="status" class="form-select" onchange="submitfilter()">
                        <option value=''><?php echo e(__('Choose status')); ?></option>
                        <option value="pending" <?php if( request()->get('status')=='pending' ): ?> selected <?php endif; ?>><?php echo e(__('Pending')); ?></option>
                        <option value="approved" <?php if( request()->get('status')=='approved' ): ?> selected <?php endif; ?>><?php echo e(__('Approved')); ?></option>
                    </select>
                </div>
            </div><!-- Col -->
            </form><!-- Filter form -->
    </div><!-- Filters -->
</section><!-- Product Filter -->

<section class="product-items d-flex justify-content-between flex-wrap">
    <?php $__currentLoopData = $allemp_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="product-item shadow-box text-center">
        <span class="badge-default <?php echo e($products->status); ?>"><?php if($products->status=='pending'): ?><?php echo e(__('Please fill your information')); ?><?php else: ?> <?php echo e(__('Approved')); ?> <?php endif; ?></span>
        <a href="<?php echo e(route('emp.detail',$products->id)); ?>" class="product-img"><img src="<?php echo e(asset($products->product_thambnail)); ?>" width="245" alt="Product"></a>
        <h5><a href="<?php echo e(route('emp.detail',$products->id)); ?>"><?php echo e($products->product_name); ?></a></h5>
    </div><!-- Product item -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
</section><!-- Product items -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    function submitfilter(){
        $("form").submit();
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/employee/employees-shop.blade.php ENDPATH**/ ?>