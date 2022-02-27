<?php $__env->startSection('content'); ?>  
<div class="welcom-popup shadow-box text-center">
    <a href="#" class="round-btn"><i class="bi bi-x-lg"></i></a>
    <h1>Welcome to your products</h1>
    <p>Your company has created a product on our page. Please fill out all the information about the product of each product below.</p>
</div><!-- Welcom popup -->
<section class="product-filter-sec ptb-45">
    <div class="filters">
        <form class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select">
                        <option selected>Choose status</option>
                        <option>Choose status</option>
                        <option>Choose status</option>
                        <option>Choose status</option>
                    </select>
                </div>
            </div><!-- Col -->
            </form><!-- Filter form -->
    </div><!-- Filters -->
</section><!-- Product Filter -->
<section class="product-items d-flex justify-content-between flex-wrap">
    <div class="product-item shadow-box text-center">
        <span class="badge-default pending">Please fill your information</span>
        <a href="#" class="product-img"><img src="<?php echo e(asset('frontend/assets/img/single-product-img02.png')); ?>" width="245" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <span class="badge-default pending">Please fill your information</span>
        <a href="#" class="product-img"><img src="<?php echo e(asset('frontend/assets/img/single-product-img02.png')); ?>" width="245" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <span class="badge-default pending">Please fill your information</span>
        <a href="#" class="product-img"><img src="<?php echo e(asset('frontend/assets/img/single-product-img02.png')); ?>" width="245" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
    </div><!-- Product item -->
    <div class="product-item shadow-box text-center">
        <span class="badge-default approved">Approved</span>
        <a href="#" class="product-img"><img src="<?php echo e(asset('frontend/assets/img/single-product-img02.png')); ?>" width="245" alt="Product"></a>
        <h5><a href="#">Name of product</a></h5>
    </div><!-- Product item -->
</section><!-- Product items -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('employee.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/employee/employees-shop.blade.php ENDPATH**/ ?>