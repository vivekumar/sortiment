<?php $__env->startSection('css'); ?>
<style>
    .hide{display:none;}
    .show{display:block;}
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="single-product shadow-box">
    <div class="back-btn">
        <a href="<?php echo e(route('dashboard')); ?>"><i class="bi bi-arrow-left-short"></i> Tilbage</a>
    </div><!-- Back button -->
    <div class="row">
        <div class="col-lg-7 col-md-12">
            <div class="product-gallery">
                <figure class="text-center">
                    <img src="<?php echo e(asset($product->product_thambnail)); ?>" alt="">
                </figure>

                <ul class="product-thumbs d-flex justify-content-center">
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
                <div class="price">Start pris: <?php echo e($product->product_price); ?> DKK</div>
                <div class="product-description">
                    <h3>Produkt beskrivelse</h3>
                    <div><?php echo $product->description; ?></div>
                </div><!-- Product description -->
                <div class="product-color d-flex align-items-center">
                    <span>Farver:</span>
                    <ul class="d-flex">
                        <li class="color"></li>
                        <li class="color"></li>
                        <li class="color"></li>
                        <li class="color"></li>
                        <li class="color"></li>
                        <li class="color"></li>
                    </ul>
                </div><!-- Product color -->
                <a href="#" id="ask-price-btn" class="btn btn-blue modal-btn" data-bs-toggle="modal" data-bs-target="#priceModal">Forespørg pris</a>
            </div><!-- Product info -->
        </div>
    </div>
</div><!-- Single product -->
<!-- Modal -->
<div class="modal fade" id="priceModal" role="dialog" aria-labelledby="priceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="priceModalLabel"><strong>Get a price for:</strong> “Name of product”</h5>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form action="" id="upload_form" method="post" class="price-form" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
                <div class="form-row mb-3 ">
                    <div class="row form-group">
                        <label for="" class="col-md-6 col-sm-12 col-form-label">Do you want your logo on the product?</label>
                        <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                            <label for="noRadio">
                                <input class="form-check-input" id="noRadio" type="radio" name="logo_on_product" value="0"> No
                            </label>
                            <label for="yesRadio">
                                <input class="form-check-input" id="yesRadio" type="radio" name="logo_on_product" value="1"> Yes
                            </label>
                        </div><!-- filed group -->
                    </div><!-- Form group -->
                    <div class="row form-group logoOnP hide">
                        <label for="" class="col-md-6 col-sm-12 col-form-label">Where do you want your logo position?</label>
                        <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                            <div class="form-check d-flex flex-wrap">
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check1" name="logo_front_left" value="Front left">
                                    <label class="form-check-label" for="check1">
                                        Front left
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check2" name="logo_front_right" value="Front right">
                                    <label class="form-check-label" for="check2">
                                        Front right
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check3" name="logo_shoulder_left" value="Shoulder left">
                                    <label class="form-check-label" for="check3">
                                        Shoulder left
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check4" name="logo_shoulder_right" value="Shoulder right">
                                    <label class="form-check-label" for="check4">
                                        Shoulder right
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check5" name="logo_onthe_back_side" value="On the backside">
                                    <label class="form-check-label" for="check5">
                                        On the backside
                                    </label>
                                </div><!-- div -->
                            </div>
                        </div><!-- filed group -->
                    </div><!-- Form group -->
                </div><!-- form row -->
                <div class="form-row mb-3 ">
                    <div class="row form-group">
                        <label for="" class="col-md-6 col-sm-12 col-form-label">Do you want to assign a text to the product?</label>
                        <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                            <label for="noRadio2">
                                <input class="form-check-input" id="noRadio2" type="radio" name="text_on_product" value="0"> No
                            </label>
                            <label for="yesRadio2">
                                <input class="form-check-input" id="yesRadio2" type="radio" name="text_on_product" value="1"> Yes
                            </label>
                        </div><!-- filed group -->
                    </div><!-- Form group -->
                    <div class="row form-group textOnP hide" >
                        <label for="" class="col-md-6 col-sm-12 col-form-label">Where do you want your text position?</label>
                        <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                            <div class="form-check d-flex flex-wrap">
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check01" name="text_front_left" value="Front left">
                                    <label class="form-check-label" for="check1">
                                        Front left
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check02" name="text_front_right" value="Front right">
                                    <label class="form-check-label" for="check2">
                                        Front right
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check03" name="text_shoulder_left" value="Shoulder left">
                                    <label class="form-check-label" for="check3">
                                        Shoulder left
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check04" name="text_shoulder_right" value="Shoulder right">
                                    <label class="form-check-label" for="check4">
                                        Shoulder right
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check05" name="text_onthe_back_side" value="On the backside">
                                    <label class="form-check-label" for="check5">
                                        On the backside
                                    </label>
                                </div><!-- div -->
                            </div>
                        </div><!-- filed group -->
                    </div><!-- Form group -->
                </div><!-- form row -->
                <div class="form-group mb-3 upload-logo">
                    <button type="button" id="btnup" class="upload-btn d-flex align-items-center">
                        <img src="<?php echo e(asset('frontend/assets/img/upload-icon.png')); ?>" class="upload-icon" alt="">
                        <p id="namefile" class="">
                            <strong>Upload your logo <small class="d-flex">Allowed files: JPG, PNG, AI, SVG & PDF</small></strong>
                        </p>
                        </button>
                        <input type="file" value="" name="logo" id="fileup">
                </div><!-- Upload logo-->
                <div class="form-group mb-3">
                    <textarea name="message" id="message" cols="" rows="" class="form-control" placeholder="Leave a note, with further information about your acquirements."></textarea>
                </div><!-- row-->
                <div class="form-group">
                    <button type="submit" id="RequestPrice" class="btn btn-blue f-width">Request price</button>
                </div><!-- row-->
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                <div id="errors"></div>
            </form><!-- Price form-->
        </div>
    </div>
    </div>
</div><!-- Price modal-->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    $(".price-form input[name='logo_on_product']").click(function() {
        var logoc=$(".price-form input[name='logo_on_product']:checked").val();
        if(1==logoc) {
            $(".logoOnP").show(300);
            $(".logoOnP").removeClass('hide');
            $(".logoOnP").addClass('show');
        } else {
            $(".logoOnP").hide(200);
        }
    });
    $(".price-form input[name='text_on_product']").click(function() {
        var logot=$(".price-form input[name='text_on_product']:checked").val();
        if(logot==1) {
            $(".textOnP").show(300);
            $(".textOnP").removeClass('hide');
            $(".textOnP").addClass('show');
        } else {
            $(".textOnP").hide(200);
        }
    });

</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      $(document).ready(function() {
        $('#upload_form').on('submit', function(event){
            $("#errors").html("")
            event.preventDefault();
            var logot=$(".price-form input[name='Radios2']:checked").val();
            var logoc=$(".price-form input[name='Radios']:checked").val();
            var check1=$("#check1").val();
            var check2=$("#check2").val();
            var check3=$("#check3").val();
            var check4=$("#check4").val();
            var check5=$("#check5").val();
            var check01=$("#check01").val();
            var check02=$("#check02").val();
            var check03=$("#check03").val();
            var check04=$("#check04").val();
            var check05=$("#check05").val();
            var message=$('#message').val();
            /*if(message==''){

            }*/
            $.ajax({
                url:"<?php echo e(route('priceRequest')); ?>",
                method:"POST",
                data:new FormData(this),
                //dataType:"json",
                processData: false,
                contentType: false,
                success:function(data) {
                    console.log(data.data);
                    console.log(data);
                    $('.modal-body').html('');
                    $('.modal-title').html('');

                    $('.modal-body').html(data.data.message);
                },
                error: function(xhr, status, error)
                {
                    $.each(xhr.responseJSON.errors, function (key, item)
                    {
                        $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                    });
                }
            });

        });
    });

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/company/single-product.blade.php ENDPATH**/ ?>