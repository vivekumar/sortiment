<?php $__env->startSection('content'); ?>
    <div class="welcom-popup shadow-box text-center">
        <a href="#" class="round-btn"><i class="bi bi-x-lg"></i></a>
        <h1>Welcome to your products</h1>
        <p>Here you can see the special deals we have made just for you, with all the special needs of your choice.</p>
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
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="product-item shadow-box text-center">
            <span class="badge-default <?php if($product->status=='ordered'): ?><?php echo e($product->status); ?> <?php elseif($product->status=='approved'): ?> <?php echo e($product->status); ?> <?php elseif($product->status=='denied'): ?> <?php echo e($product->status); ?> <?php else: ?> <?php echo e($product->status); ?> <?php endif; ?>"><?php if($product->status=='ordered'): ?>Ordered <?php elseif($product->status=='approved'): ?> Approved <?php elseif($product->status=='denied'): ?> Denied <?php else: ?> Pending approval <?php endif; ?></span>
            
            <a href="<?php echo e(route('cproduct.cstatus',$product->id)); ?>" class="product-img">
                <?php
                // set a default image
                if ($product->product_thambnail && is_file(public_path() . '/' . $product->product_thambnail)) {
                        $image = asset($product->product_thambnail);
                    } else {
                        $image = asset('frontend/assets/img/product-img01.png');
                    }
                ?>
                <img src="<?php echo e(asset($image)); ?>" alt="Product">
            </a>
            <h5><a href="#"><?php echo e($product->product_name); ?></a></h5>
            <p class="price">Price from: <?php echo e($product->product_price); ?> DKK</p>
        </div><!-- Product item -->
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        
    </section><!-- Product items -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
function addToCart(){
        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var color = $('#color option:selected').text();
        var size = $('#size option:selected').text();
        var quantity = $('#qty').val();
        $.ajax({
            type: "POST",
            dataType: 'json',
            data:{
                color:color, size:size, quantity:quantity, product_name:product_name
            },
            url: "/cart/data/store/"+id,
            success:function(data){
                console.log(data)

                // Start Message
                const Toast = Swal.mixin({
                      toast: true,
                      position: 'top-end',
                      icon: 'success',
                      showConfirmButton: false,
                      timer: 3000
                    })
                if ($.isEmptyObject(data.error)) {
                    Toast.fire({
                        type: 'success',
                        title: data.success
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title: data.error
                    })
                }
                // End Message

            }
        })
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/company/my-product.blade.php ENDPATH**/ ?>