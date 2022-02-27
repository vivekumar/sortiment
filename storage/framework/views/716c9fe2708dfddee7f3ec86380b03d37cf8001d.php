<?php $__env->startSection('content'); ?>


<div class="welcom-popup shadow-box text-center">
    <a href="#" class="round-btn"><i class="bi bi-x-lg"></i></a>
    <h1>Welcome to the shop</h1>
    <p>Here you can see all of our products click on any of them to get the right price just for you!</p>
</div><!-- Welcom popup -->
<section class="product-filter-sec ptb-45">
    <div class="filters">
        <form class="row g-3">
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select">
                        <option selected>-----Category------</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div><!-- Col -->

            <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" name="attribute_id" value="<?php echo e($attribute->id); ?>">
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select">
                        <option selected>---<?php echo e($attribute->attr_name); ?>---</option>
                        <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attrValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($attrValue->id); ?>"><?php echo e($attrValue->attr_value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div><!-- Col -->
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select">
                        <option selected>---- Brand ----</option>
                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->brand_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div><!-- Col -->
            </form><!-- Filter form -->
    </div><!-- Filters -->
</section><!-- Product Filter -->

<section class="product-items d-flex justify-content-between flex-wrap">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="product-item shadow-box text-center">
        <a href="<?php echo e(route('product.detail',$product->id)); ?>" class="product-img"><img src="<?php echo e(asset($product->product_thambnail)); ?>" alt="Product"></a>
        <h5><a href="#"><?php echo e($product->product_name); ?></a></h5>
        <p class="price">Request a price</p>
    </div><!-- Product item -->
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
</section><!-- Product items -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/company/index.blade.php ENDPATH**/ ?>