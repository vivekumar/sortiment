<?php $__env->startSection('content'); ?>
<div class="single-product shadow-box">
    <div class="back-btn">
        <a href="<?php echo e(route('myproduct')); ?>"><i class="bi bi-arrow-left-short"></i> Tilbage</a>
    </div><!-- Back button -->
    <div class="row">
        <div class="col-lg-7 col-md-12">
            <div class="product-gallery">
                <figure class="text-center">
                    <img src="<?php echo e(asset($product->product_thambnail)); ?>" alt="">
                </figure>
                <ul class="product-thumbs d-flex">
                    <?php $__currentLoopData = $product->mutimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mutimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <a href="#"><img src="<?php echo e(asset($mutimage->photo_name)); ?>" alt=""></a>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div><!-- Product gallery -->
        </div>
        <div class="col-lg-5 col-md-12">
            <div class="product-info">
                <h1><?php echo e($product->product_name); ?></h1>
                <div class="price">Price: <?php echo e($product->product_price); ?> DKK</div>
                <div class="qty-price-table">
                    <a class="qty-toggle" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Toggle quantity prices
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th>Quantity</th>
                                    <th>Price pr. item</th>
                                    </tr>
                                </thead>
                                    <tr>
                                    <td>0</td>
                                    <td><?php echo e($product->price1); ?> DKK</td>
                                    </tr>
                                    <tr>
                                    <td>10</td>
                                    <td><?php echo e($product->price2); ?> DKK</td>
                                    </tr>
                                    <tr>
                                    <td>25</td>
                                    <td><?php echo e($product->price3); ?> DKK</td>
                                    </tr>
                                    <tr>
                                    <td>50</td>
                                    <td><?php echo e($product->price4); ?> DKK</td>
                                    </tr>
                                    <tr>
                                    <td>100+</td>
                                    <td><?php echo e($product->price5); ?> DKK</td>
                                    </tr>
                                </table>
                        </div>
                        </div>
                </div><!-- Qty price -->
                <?php if($product->status=='approved'): ?>
                <form action="<?php echo e(route('cart.store',$product->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                <div class="product-order d-none1">
                    <div class="qty-col">
                        <span>Quantity</span>
                        <input type="number" placeholder="0" class="qty" name="quantity" min="1" value="1">
                    </div><!-- Qty -->
                    <button class="btn btn-blue order-btn">Order now</button>
                </div><!-- product-order -->
                </form>
                <?php elseif($product->status=='pending'): ?>
                <div class="btn-row">
                    <a href="<?php echo e(route('changeProductStatus',$product->id)); ?>" class="btn green-btn">Approve</a>
                    <a href="javascript:void(0);" class="btn red-btn" data-bs-toggle="modal" data-bs-target="#denyModal">Deny</a>
                </div>
                <?php else: ?>
                <?php endif; ?>
                <div class="download-pdf text-center">
                    <a href="#">DOWNLOAD PRODUCT PDF <i class="far fa-file-pdf"></i></a>
                </div><!-- Download Pdf -->
            </div><!-- Product info -->
        </div>
    </div>
</div><!-- Single product -->

<!-- Modal -->
<div class="modal fade" id="denyModal" role="dialog" aria-labelledby="denyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="denyModalLabel"><strong>What was the reason
            for the denial?</strong></h5>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form action="" class="price-form">

                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>" id="product_id">
                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>" id="user_id">
                <div class="form-group mb-3">
                    <textarea name="" id="denytext" cols="" rows="" class="form-control" placeholder="Lorem Ipsum is simply dummy text of the printing and typesetting industry. "></textarea>
                </div><!-- row-->
                <div class="form-group">
                    <button type="button" class="btn btn-blue f-width" id="denyed">Submit</button>
                </div><!-- row-->
                <div id="errors"></div>
            </form><!-- Price form-->
        </div>
    </div>
    </div>
</div><!-- Price modal-->


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#denyed").click(function() {
        var deny_text=$("#denytext").val();
        var product_id=$("#product_id").val();
        var user_id=$("#user_id").val();
        if(deny_text) {
            $.ajax({
                url:"<?php echo e(route('productDeny')); ?>",
                method:"POST",
                data:{'deny_text':deny_text,'product_id':product_id,'user_id':user_id},
                //dataType:"json",
                //processData: false,
                //contentType: false,
                beforeSend: function() {
                    // setting a timeout
                   // $('#denyed').addClass('loading');
                    $('#denyed').attr('disabled','disabled');
                },
                success:function(data) {
                    //$('.modal-body').apend('');
                    window.location.href = "<?php echo e(route('myproduct')); ?>";
                    $('#denyModal').modal('hide');
                },
                error: function(xhr, status, error)
                {
                    $.each(xhr.responseJSON.errors, function (key, item)
                    {
                        $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                    });
                },
                complete: function() {
                    //$(placeholder).removeClass('loading');
                    $('#denyed').removeAttr('disabled');
                },
            });
        }
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/company/single-product-status-change.blade.php ENDPATH**/ ?>