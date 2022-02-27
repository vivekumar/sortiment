<?php $__env->startSection('css'); ?>
<style>
    .products-con div#orderModal .modal-dialog {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="single-product shadow-box">
    <div class="back-btn">
        <a href="<?php echo e(route('myproduct')); ?>"><i class="bi bi-arrow-left-short"></i> Tilbage</a>
    </div><!-- Back button -->
    <div class="row">
        <div class="col-lg-7 col-md-12">

            <!--img-products-->
            <div class="img-products">
                <div class="owl-carousel owl-theme big" id="big">
                    <div class="item">
                        <figure class="zoom" onmousemove="zoom(event)" style="background-image: url(<?php echo e(asset($product->product_thambnail)); ?>)">
                            <img src="<?php echo e(asset($product->product_thambnail)); ?>" />
                        </figure>
                    </div>
                    <?php $__currentLoopData = $product->mutimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mutimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <figure class="zoom" onmousemove="zoom(event)" style="background-image: url(<?php echo e(asset($mutimage->photo_name)); ?>)">
                            <img src="<?php echo e(asset($mutimage->photo_name)); ?>" />
                    </figure>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

                <!--thumbs-->
                <div class="owl-carousel owl-theme" id="thumbs">
                    <div class="item">
                        <img alt="" class="img-responsive" src="<?php echo e(asset($product->product_thambnail)); ?>"/>
                    </div>
                    <?php $__currentLoopData = $product->mutimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mutimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="item">
                            <img alt="" class="img-responsive" src="<?php echo e(asset($mutimage->photo_name)); ?>"/>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div><!--/thumbs-->
            </div><!--/img-products-->


        </div>

<?php //print_r(count($distincts));?>

        <div class="col-lg-5 col-md-12">
            <div class="product-info">
                <h1><?php echo e($product->product_name); ?></h1>
                <div class="price">Pris fra : DKK <?php echo e(round($product->product_price)); ?> <small>(ex. moms)</small> </div>
                <div class="qty-price-table">
                    <a class="qty-toggle" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <?php echo e(__('See sales prices per. PCS.')); ?>

                    </a>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body table-responsive">

                            <table class="table">
                                <thead>
                                    <tr>
                                    <th><?php echo e(__('Quantity')); ?></th>
                                    <th><?php echo e(__('Price pr. item')); ?></th>
                                    </tr>
                                </thead>
                                <?php $__currentLoopData = $mqtyprice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $qtyprice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                    <td><?php echo e($qtyprice->qty); ?></td>
                                    <td><?php echo e($qtyprice->price); ?> DKK</td>
                                    </tr>
                                    <tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </table>
                        </div>
                    </div>
                </div><!-- Qty price -->
                <div>
                <?php echo $product->description; ?>

                </div>
                <?php if($product->status=='approved'): ?>
                <form action="<?php echo e(route('cart.store',$product->id)); ?>" method="post" id="order_now_form">
                    <?php echo csrf_field(); ?>
                <div class="product-order d-none1">
                    <div class="qty-col">
                        <span><?php echo e(__('Quantity')); ?></span>
                        <input type="number" placeholder="0" class="qty" name="quantity" min="1" value="1" >
                    </div><!-- Qty -->
                    <button class="btn btn-blue order-btn" type="button" id="order_now"><?php echo e(__('Put the number in the basket')); ?></button>
                </div><!-- product-order -->
                </form>
                <?php elseif($product->status=='pending'): ?>
                <div class="btn-row">
                    <a href="<?php echo e(route('changeProductStatus',$product->id)); ?>" class="btn green-btn"><?php echo e(__('Approve')); ?></a>
                    <a href="javascript:void(0);" class="btn red-btn" data-bs-toggle="modal" data-bs-target="#denyModal"><?php echo e(__('Deny')); ?></a>
                </div>
                <?php else: ?>
                <?php endif; ?>
                <?php if(!empty($product->product_pdf)): ?>
                <div class="download-pdf text-center">
                    <a href="<?php echo e(asset($product->product_pdf)); ?>" download><?php echo e(__('Download product pdf')); ?> <i class="far fa-file-pdf"></i></a>
                </div><!-- Download Pdf -->
                <?php endif; ?>
            </div><!-- Product info -->
        </div>
    </div>
</div><!-- Single product -->

<!-- Modal -->
<div class="modal fade" id="denyModal" role="dialog" aria-labelledby="denyModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="denyModalLabel"><strong><?php echo e(__('What was the reason
            for the denial')); ?>?</strong></h5>
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



<!-- Modal -->
<div class="modal fade" id="orderModal" role="dialog" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="orderModalLabel"><strong>Læg i kurven</strong></h5>
        <button type="button" onclick="closeModel()" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <p>Du er i gang med at bestille en større ordre.</p>

            <p>Denne kræver gruppering efter Størrelse, for at blive håndteret korrekt i shoppen.</p>

            <p>Angiv nedenfor hvor mange forskellige størrelser du ønsker grupperet efter (Dette kan ændres efterfølgende).
            Det valgte antal størrelser vises som linjer i kurven, og kan efterfølgende udfyldes med ønsket størrelse og antal.</p>

            <form action="<?php echo e(route('cart.store',$product->id)); ?>" method="post">
                    <?php echo csrf_field(); ?>
                <div class="product-order d-none1">
                    <div class="qty-col">
                        <span><?php echo e(__('Quantity')); ?></span>
                        <input type="number" placeholder="0" class="qty" name="quantity" min="1" value="1" >
                    </div><!-- Qty -->
                    <button class="btn btn-blue order-btn" type="submit" id="order_now"><?php echo e(__('Godkend')); ?></button>
                </div><!-- product-order -->
            </form>
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



const button1 = document.querySelector('#big');
button1.addEventListener('click' , openWindow);
//var popur="<?php echo e(route('download.miltimg.pdf',$product->id)); ?>";
var popur="<?php echo e(asset($product->product_pdf)); ?>";
var checkpdf="<?php echo e($product->product_pdf); ?>";
function openWindow(){
	//open(popur , '_blank' , 'width=1400,height=500,left=100,top=200');
    if(checkpdf!=""){
        open(popur , '_blank' , 'width=1200,height=600,left=100,top=200');
    }
}
$("#order_now").click(function() {
    var qty=$('.qty').val();
    var label="<?php echo e($product->name_on_product); ?>";
    var attribute=<?php echo e(count($distincts)); ?>;
    console.log(attribute);
    if(qty>24  && attribute > 0 ){ //&& label=='no'
       // $('.products-con').append('<div class="modal-backdrop fade show"></div>');
        //$('#orderModal').modal('show');
        $('#orderModal').removeClass('fade');
        $('.products-con').append('<div class="modal-backdrop fade show"></div>');
        //$("#pid").val(id);
        $('#orderModal').show();
    }else{
        $('#order_now_form').submit();
    }
});
function closeModel(){
    $('#orderModal').addClass('fade');
    $('.modal-backdrop').remove();

    $('#orderModal').hide();
}

</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/company/single-product-status-change.blade.php ENDPATH**/ ?>