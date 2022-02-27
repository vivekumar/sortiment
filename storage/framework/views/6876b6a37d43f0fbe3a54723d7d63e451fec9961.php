<?php $__env->startSection('content'); ?>
    <div class="welcom-popup shadow-box text-center">
        <a href="#" class="round-btn" onClick="$(this).parent().remove()"><i class="bi bi-x-lg"></i></a>
        <h1><?php echo e(__('Welcome')); ?> <?php echo e(Auth::user()->company); ?></h1>
        <!--<p>Brug shoppen ligeså tosset du vil <br>Tøv ikke med at kontakte os hvis du har spørgsmål eller oplever udfordringer.</p>-->
        <p>Her vil du finde dit helt egen Sortiment</p>
    </div><!-- Welcom popup -->
    <section class="product-filter-sec ptb-45">
        <div class="filters">
            <form class="row g-3" method="get" action="">
                <div class="col-lg-3 col-md-6">
                    <div class="select">
                        <select class="form-select" name="status" onchange="submitfilter()">
                            <option value=""><?php echo e(__('Choose status')); ?></option>
                            <option value="pending" <?php if(isset($_GET['status']) && $_GET['status']=='pending'): ?> selected <?php endif; ?>><?php echo e(__('Pending approval')); ?></option>
                            <option value="approved" <?php if(isset($_GET['status']) && $_GET['status']=='approved'): ?> selected <?php endif; ?>><?php echo e(__('Approved')); ?></option>
                            <option value="ordered" <?php if(isset($_GET['status']) && $_GET['status']=='ordered'): ?> selected <?php endif; ?>><?php echo e(__('Ordered')); ?></option>
                            <option value="denied" <?php if(isset($_GET['status']) && $_GET['status']=='denied'): ?> selected <?php endif; ?>><?php echo e(__('Denied')); ?></option>
                        </select>

                    </div>
                </div><!-- Col -->
            </form><!-- Filter form -->
        </div><!-- Filters -->
    </section><!-- Product Filter -->
    <section class="row product-items d-flex justify-content-between1 flex-wrap">
        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-3">
        <div class="product-item shadow-box text-center">
            <span class="badge-default <?php if($product->status=='ordered'): ?><?php echo e($product->status); ?> <?php elseif($product->status=='approved'): ?> <?php echo e($product->status); ?> <?php elseif($product->status=='denied'): ?> <?php echo e($product->status); ?> <?php else: ?> <?php echo e($product->status); ?> <?php endif; ?>"><?php if($product->status=='ordered'): ?> <?php echo e(__('Ordered')); ?> <?php elseif($product->status=='approved'): ?> <?php echo e(__('Approved')); ?> <?php elseif($product->status=='denied'): ?> <?php echo e(__('Denied')); ?> <?php else: ?> <?php echo e(__('Pending approval')); ?> <?php endif; ?></span>

            <a href="<?php echo e(route('cproduct.cstatus',$product->id)); ?>" class="product-img">
                <?php
                // set a default image is_file(public_path() . '/' . $product->product_thambnail)
                // $pthumbnail= asset($product->product_thambnail);

                if ($product->product_thambnail) {
                        $image = asset($product->product_thambnail);
                    } else {
                        $image = asset('frontend/assets/img/product-img01.png');
                    }
                ?>
                <img src="<?php echo e(asset($image)); ?>" alt="Product">
            </a>
            <h5><a href="#"><?php echo e($product->product_name); ?></a></h5>
            <p class="price"><?php echo e(__('Price from')); ?>: DKK <?php echo e(round($product->product_price)); ?> <small>(ex. moms)</small> </p>
        </div><!-- Product item -->
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <div class="paginate">
        
        </div>
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

<script>
    function submitfilter(){
        $("form").submit();
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/company/my-product.blade.php ENDPATH**/ ?>