<?php $__env->startSection('css'); ?>
<style>
    .hide{display:none!important;}
    .show{display:block;}
    .products-con{z-index: 9;}
    #imgPopup_modal .modal-dialog {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }

</style>

 <!-- Plugin CSS -->
 <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/product-slider/vendor/photoswipe/photoswipe.min.css')); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/product-slider/vendor/photoswipe/default-skin/default-skin.min.css')); ?>">
    <!-- Swiper CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/product-slider/vendor/swiper/swiper-bundle.min.css')); ?>">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/product-slider/css/style.min.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="single-product shadow-box">
    <div class="back-btn">
        <a href="<?php echo e(route('dashboard')); ?>"><i class="bi bi-arrow-left-short"></i> Tilbage</a>
    </div><!-- Back button -->
    <div class="product product-single row ">

        <div class="col-lg-7 col-md-12">
           <!-- =============Product Zoom Effect Code Start=============== -->
            
           <!-- =============Product Zoom Effect Code ENd=============== -->


                    <div class="product-gallery product-gallery-sticky product-gallery-vertical">
                        <div class="swiper-container product-single-swiper swiper-theme nav-inner"
                            data-swiper-options="{
                            'navigation': {
                                'nextEl': '.swiper-button-next',
                                'prevEl': '.swiper-button-prev'
                            }
                        }">
                            <div class="swiper-wrapper row cols-1 gutter-no">
                                <div class="swiper-slide">
                                    <figure class="product-image">
                                        <img src="<?php echo e(asset($product->product_thambnail)); ?>"
                                            data-zoom-image="<?php echo e(asset($product->product_thambnail)); ?>"
                                            alt="" width="800"
                                            height="900">
                                    </figure>
                                </div>
                                <?php $__currentLoopData = $product->mutimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mutimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="swiper-slide">
                                    <figure class="product-image">
                                        <img src="<?php echo e(asset($mutimage->photo_name)); ?>"
                                            data-zoom-image="<?php echo e(asset($mutimage->photo_name)); ?>"
                                            alt="" width="488"
                                            height="549">
                                    </figure>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                            <button class="swiper-button-next"></button>
                            <button class="swiper-button-prev"></button>
                            <a href="#" class="product-gallery-btn product-image-full"><i class="fa fa-search-plus" aria-hidden="true"></i></a>
                        </div>
                        <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                            'navigation': {
                                'nextEl': '.swiper-button-next',
                                'prevEl': '.swiper-button-prev'
                            },
                            'breakpoints': {
                                '992': {
                                    'direction': 'vertical',
                                    'slidesPerView': 'auto'
                                }
                            }
                        }">
                            <div class="product-thumbs swiper-wrapper row cols-lg-1 cols-4 gutter-sm">
                                <div class="product-thumb swiper-slide">
                                    <img src="<?php echo e(asset($product->product_thambnail)); ?>"
                                        alt="Product Thumb" width="800" height="900">
                                </div>

                                <?php $__currentLoopData = $product->mutimage; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mutimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="product-thumb swiper-slide">
                                    <img src="<?php echo e(asset($mutimage->photo_name)); ?>"
                                        alt="Product Thumb" width="800" height="900">
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>
                            <button class="swiper-button-prev"></button>
                            <button class="swiper-button-next"></button>
                        </div>
                    </div>





        </div><!-- colose col-lg-7 -->

        <!-- =========Model Code Start============ -->
        

<!-- =========Model Code Start============ -->

        <?php
            $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
        ?>

        <div class="col-lg-5 col-md-12">
            <div class="product-info">
                <h1><?php echo e($product->product_name); ?></h1>
                <div class="price">Pris fra:  <?php echo e($formatter->formatCurrency(round($product->product_price), 'DKK'), PHP_EOL); ?> </div>
                <div class="product-description">
                    <h3>Produkt beskrivelse</h3>
                    <div><?php echo $product->description; ?></div>
                </div><!-- Product description -->
                <div class="product-color d-flex1 align-items-center">

                        <?php
                        //$color = [];
                        $sizes = [];
                        $combinations=DB::table('product_attributes')->where('product_id',$product->id)->get();

                        foreach($distincts as $distinct)
                        {
                            $attributs=DB::table('product_attributes')->where('product_id',$product->id)->where('attribute_id',$distinct->attribute_id)->get();

                            $att=\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name');
                            echo '<span>'.__(\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name')).':</span>
                            <ul class="d-flex flex-wrap '.$att.'">';
                            $style='';
                            $atttt=[];
                            foreach($attributs as $key=>$attribut){
                                $ddddd=\App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_code');
                                $atttt[$ddddd]=\App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_order');
                            }

                            asort($atttt);

                            foreach($atttt as $key11=>$attribut11){
                                if($att=="Color"){
                                    $style='background-color:'.$key11;
                                }else{
                                    $style='';
                                }


                                echo '<li class="color " style="'.$style.'">'.$key11.'</li>';
                            }
                            echo "</ul>";
                        }
                        ?>

                    <!--
                    <span>Farver:</span>
                    <ul class="d-flex">
                        <li class="color"></li>
                        <li class="color"></li>
                        <li class="color"></li>
                        <li class="color"></li>
                        <li class="color"></li>
                        <li class="color"></li>
                    </ul>-->
                </div><!-- Product color -->

                <a href="#" id="ask-price-btn" class="btn btn-blue modal-btn" data-bs-toggle="modal" data-bs-target="#priceModal">Forespørg pris</a>
                <?php if(!empty($product->product_pdf)): ?>
                <div class="download-pdf text-center">
                    <a href="<?php echo e(asset($product->product_pdf)); ?>" target="__blank" download><?php echo e(__('Download produkt info')); ?> <i class="far fa-file-pdf"></i></a>
                </div><!-- Download Pdf -->
                <?php endif; ?>
            </div><!-- Product info -->
        </div>
    </div>
</div><!-- Single product -->




<!-- Modal -->
<div class="modal fade" id="priceModal" role="dialog" aria-labelledby="priceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="priceModalLabel"><strong><?php echo e(__('Get a price for')); ?>:</strong> <?php echo e($product->product_name); ?></h5>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form action="" id="upload_form" method="post" class="price-form" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
                <?php if($product->logo_on_product==1 && !empty($product->logo_value)): ?>
                <div class="form-row mb-3 ">
                    <div class="row form-group">
                        <label for="" class="col-md-6 col-sm-12 col-form-label"><?php echo e(__('Do you want your logo on the product')); ?>?</label>
                        <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                            <label for="noRadio">
                                <input class="form-check-input" id="noRadio" type="radio" name="logo_on_product" value="0" checked> <?php echo e(__('No')); ?>

                            </label>
                            <label for="yesRadio">
                                <input class="form-check-input" id="yesRadio" type="radio" name="logo_on_product" value="1"> <?php echo e(__('Yes')); ?>

                            </label>
                        </div><!-- filed group -->
                    </div><!-- Form group -->
                    <div class="row form-group logoOnP hide">
                        <label for="" class="col-md-6 col-sm-12 col-form-label"><?php echo e(__('Where do you want your logo position')); ?>?</label>
                        <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                            <div class="form-check d-flex flex-wrap">
                                <?php if(isset($product->logo_value)&&!empty($product->logo_value)): ?>
                                <?php $arraylogoposition=explode('|',$product->logo_value); ?>
                                <?php $__currentLoopData = $arraylogoposition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$logoposition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check<?php echo e($key); ?>" name="logo_value[]" value="<?php echo e($logoposition); ?>">
                                    <label class="form-check-label" for="check<?php echo e($key); ?>">
                                        <?php echo e($logoposition); ?>

                                    </label>
                                </div><!-- div -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                
                            </div>
                        </div><!-- filed group -->
                    </div><!-- Form group -->
                </div><!-- form row -->
                <?php endif; ?>
                <?php if($product->text_on_product==1 && !empty($product->text_value)): ?>
                <div class="form-row mb-3 ">
                    <div class="row form-group">
                        <label for="" class="col-md-6 col-sm-12 col-form-label"><?php echo e(__('Do you want to assign a text to the product')); ?>?</label>
                        <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                            <label for="noRadio2">
                                <input class="form-check-input" id="noRadio2" type="radio" name="text_on_product" value="0" checked> <?php echo e(__('No')); ?>

                            </label>
                            <label for="yesRadio2">
                                <input class="form-check-input" id="yesRadio2" type="radio" name="text_on_product" value="1"> <?php echo e(__('Yes')); ?>

                            </label>
                        </div><!-- filed group -->
                    </div><!-- Form group -->
                    <div class="row form-group textOnP hide" >
                        <label for="" class="col-md-6 col-sm-12 col-form-label"><?php echo e(__('Where do you want your text position')); ?>?</label>
                        <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                            <div class="form-check d-flex flex-wrap">
                                <?php if(isset($product->text_value)&&!empty($product->text_value)): ?>
                                <?php $arraylogoposition=explode('|',$product->text_value); ?>
                                <?php $__currentLoopData = $arraylogoposition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$logoposition): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check1<?php echo e($key); ?>" name="text_value[]" value="<?php echo e($logoposition); ?>">
                                    <label class="form-check-label" for="check1<?php echo e($key); ?>">
                                        <?php echo e($logoposition); ?>

                                    </label>
                                </div><!-- div -->
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                                
                            </div>
                        </div><!-- filed group -->
                    </div><!-- Form group -->
                </div><!-- form row -->
                <?php endif; ?>
                <div class="form-group mb-3 upload-logo">
                    <div class="sec_logo">
                        <div class="upload_logo">
                            <button type="button" id="btnup" class="upload-btn d-flex align-items-center">
                            <img src="<?php echo e(asset('frontend/assets/img/upload-icon.png')); ?>" class="upload-icon" alt="">
                            <p id="namefile" class="">
                                <strong><?php echo e(__('Upload your logo')); ?> <small class="d-flex"><?php echo e(__('Allowed files')); ?>: EPS,JPG, PNG, AI, SVG & PDF</small></strong>
                            </p>
                            </button>
                            <input type="file" value="" name="logo" id="fileup">
                        </div>
                        <div class="sec-logo-flex">
                            <?php $__currentLoopData = $allimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="custom_logo">
                                <input type="radio" name="profile_logo" data-waschecked="false" id="cb<?php echo e($allimage->id); ?>" value="<?php echo e($allimage->image); ?>" />
                                <label for="cb<?php echo e($allimage->id); ?>">
                                    <img src="<?php echo e(asset($allimage->image)); ?>" />
                                </label>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div><!-- Upload logo-->
                <div class="form-group mb-3">
                    <textarea name="message" id="message" cols="" rows="" class="form-control" placeholder="<?php echo e(__('Leave a note, with further information about your acquirements')); ?>."></textarea>
                </div><!-- row-->
                <div class="form-group">
                    <button type="submit" id="RequestPrice" class="btn btn-blue f-width">Send forspørgsel</button>
                </div><!-- row-->
                <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                <div id="errors"></div>
            </form><!-- Price form-->
        </div>
    </div>
    </div>
</div><!-- Price modal-->

<!-- Modal -->
<div class="modal fade" id="imgPopup_modal" role="dialog" aria-labelledby="priceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header justify-content-center text-center">
                <h5 class="modal-title"></h5>
                <button type="button" class="btn-close round-btn" onclick="closeModel()" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
            </div>

            <div class="modal-body text-center">
                <div class="img-pfd">
                     <img src="" />
                </div>

                <!--<div class="btn-download-pdf btn-group-sm mt-15" style="margin-top:15px;">
                    <a href="" class="btn btn-primary btn-sm" download>Download</a>
                </div>-->
            </div>
        </div>
    </div>
</div>
<!-- Price modal-->










<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>


    <!-- Start of Scroll Top -->
    <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i> <svg
            version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
            <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35" cy="35"
                r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
        </svg> </a>
    <!-- End of Scroll Top -->



    <!-- Root element of PhotoSwipe. Must have class pswp -->
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

        <!-- Background of PhotoSwipe. It's a separate element as animating opacity is faster than rgba(). -->
        <div class="pswp__bg"></div>

        <!-- Slides wrapper with overflow:hidden. -->
        <div class="pswp__scroll-wrap">

            <!-- Container that holds slides.
			PhotoSwipe keeps only 3 of them in the DOM to save memory.
			Don't modify these 3 pswp__item elements, data is added later on. -->
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>

            <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
            <div class="pswp__ui pswp__ui--hidden">

                <div class="pswp__top-bar">

                    <!--  Controls are self-explanatory. Order can be changed. -->

                    <div class="pswp__counter"></div>

                    <button class="pswp__button pswp__button--close" aria-label="Close (Esc)"></button>
                    <button class="pswp__button pswp__button--zoom" aria-label="Zoom in/out"></button>

                    <div class="pswp__preloader">
                        <div class="loading-spin"></div>
                    </div>
                </div>

                <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                    <div class="pswp__share-tooltip"></div>
                </div>

                <button class="pswp__button--arrow--left" aria-label="Previous (arrow left)"></button>
                <button class="pswp__button--arrow--right" aria-label="Next (arrow right)"></button>

                <div class="pswp__caption">
                    <div class="pswp__caption__center"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of PhotoSwipe -->
<script>
/*=====================================================================
===================== Product-Slider-with-zoom start Code 21-10-2021 =================
========================================================================*/
/*$(document).ready(function () {
    var bigimage = $(".big");
    var thumbs = $("#thumbs");
    var bigPopup = $("#big-popup");
    // var totalslides = 10;
    var syncedSecondary = true;
    bigimage
        .owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: true,
            autoplay: false,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: [
                '<i class="bi bi-arrow-left-short"></i>',
                '<i class="bi bi-arrow-right-short"></i>'
            ]
        })
        .on("changed.owl.carousel", syncPosition);

// ============POPUP CODE START=================
            bigPopup
        .owlCarousel({
            items: 1,
            slideSpeed: 2000,
            nav: true,
            autoplay: false,
            dots: false,
            loop: true,
            responsiveRefreshRate: 200,
            navText: [
                '<i class="bi bi-arrow-left-short"></i>',
                '<i class="bi bi-arrow-right-short"></i>'
            ]
        })
        .on("changed.owl.carousel", syncPosition);


// ============POPUP CODE END=================


    thumbs
        .on("initialized.owl.carousel", function () {
            thumbs
                .find(".owl-item")
                .eq(0)
                .addClass("current");
        })
        .owlCarousel({
            items: 1,
            dots: true,
            nav: true,
            navText: [
                '<i class="bi bi-arrow-left-short"></i>',
                '<i class="bi bi-arrow-left-short"></i>'
            ],
            autoplay: false,
            smartSpeed: 2000000,
            slideSpeed: 5000000,
            slideBy: 1,
            responsiveRefreshRate: 100
        })
        .on("changed.owl.carousel", syncPosition2);

    function syncPosition(el) {
        //if loop is set to false, then you have to uncomment the next line
        //var current = el.item.index;

        //to disable loop, comment this block
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }
        //to this
        thumbs
            .find(".owl-item")
            .removeClass("current")
            .eq(current)
            .addClass("current");
        var onscreen = thumbs.find(".owl-item.active").length - 1;
        var start = thumbs
            .find(".owl-item.active")
            .first()
            .index();
        var end = thumbs
            .find(".owl-item.active")
            .last()
            .index();

        if (current > end) {
            thumbs.data("owl.carousel").to(current, 100, false);
        }
        if (current < start) {
            thumbs.data("owl.carousel").to(current - onscreen, 100, false);
        }
    }

    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            bigimage.data("owl.carousel").to(number, 100, false);
        }
    }

    thumbs.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        bigimage.data("owl.carousel").to(number, 300, false);
    });

// =========poppup COde Start=========
    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            bigPopup.data("owl.carousel").to(number, 100, false);
        }
    }

    thumbs.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        bigPopup.data("owl.carousel").to(number, 300, false);
    });

    // =========poppup COde END=========

});
*/
// ============Images Zoom COde Start=================

function ImageSizer(){
  var me          = this;
  this.img        = null;
  this.zoomInBtn  = null;
  this.zoomOutBtn = null;

  this.init = function (){

    me.img        = "._9gag";
    me.zoomInBtn  = $("#zoomIn")[0];
    me.zoomOutBtn = $("#zoomOut")[0];

    $(me.zoomInBtn).click(function(){
     
      var scale   = 2;
      var xNew    = 0;
      var yNew    = 105;
      var xImage  = 59;
      var yImage  = 55;

      me.zoomIn(me.img,scale, xNew, yNew, xImage, yImage);

    });

    $(me.zoomOutBtn).click(function(){

      me.zoomOut(me.img);

    });

  };

  /**
   * @img  ชื่อ class หรือ id
   */
  this.zoomOut = function(img){

        $(img).removeAttr("style");

    };

  /**
   * @img  ชื่อ .class หรือ #id
   * @scale  ระดับการ zoom
   * @xNew  ตำแหน่ง x ที่เริ่ม zoom
   * @yNew  ตำแหน่ง y ที่เริ่ม zoom
   * @xImage  ตำแหน่ง x ที่จะซูม
   * @yImage  ตำแหน่ง y ที่จะซูม
   */
  this.zoomIn = function(img, scale, xNew, yNew, xImage, yImage){

    var translate = 'translate(' + xNew + 'px, ' + yNew + 'px' + ')';

    $(img)
        // Safari and Chrome
        .css('-webkit-transform', 'scale(' + scale + ')' + translate)
        .css('-webkit-transform-origin', xImage + 'px ' + yImage + 'px')
        // Firefox
        .css('-moz-transform', 'scale(' + scale + ')' + translate)
        .css('-moz-transform-origin', xImage + 'px ' + yImage + 'px')
        // IE 9
        .css('-ms-transform', 'scale(' + scale + ')' + translate)
        .css('-ms-transform-origin', xImage + 'px ' + yImage + 'px')
        //Opera
        .css('-o-transform', 'scale(' + scale + ')' + translate)
        .css('-o-transform-origin', xImage + 'px ' + yImage + 'px');

    };
}
$(document).ready(function(){
  var is = new ImageSizer();
  is.init();

});
// ============Images Zoom COde End=================
/*=====================================================================
========================== Product-Slider-with-zoom End Code 21-10-2021 =========================
========================================================================*/
</script>
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
var myModal = document.getElementById('priceModal');
var myModal2 = document.getElementById('imgPopup_modal');

myModal.addEventListener('shown.bs.modal', function () {
  $('body').css('overflow-y',"auto");
})

myModal2.addEventListener('shown.bs.modal', function () {
  $('body').css('overflow-y',"auto");
  console.log($(this+' '+'.img-pfd').html());
})

function showbig(that,bimg){
    console.log(bimg);
    $('#imgPopup_modal').removeClass('fade');
    $('.products-con').append('<div class="modal-backdrop fade show"></div>');
    $('#imgPopup_modal img').attr('src', bimg);
    $('#imgPopup_modal a').attr('href', bimg);
    $('#imgPopup_modal').show();
    $('body').css('overflow-y',"auto");
}

function closeModel(){
    $('#imgPopup_modal').addClass('fade');
    $('.modal-backdrop').remove();

    $('#imgPopup_modal').hide();
}
</script>



<script src="<?php echo e(asset('frontend/product-slider/vendor/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/product-slider/vendor/zoom/jquery.zoom.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/product-slider/vendor/photoswipe/photoswipe.min.js')); ?>"></script>
    <script src="<?php echo e(asset('frontend/product-slider/vendor/photoswipe/photoswipe-ui-default.min.js')); ?>"></script>

    <!-- Swiper JS File -->
    <script src="<?php echo e(asset('frontend/product-slider/vendor/swiper/swiper-bundle.min.js')); ?>"></script>

    <!-- Main JS File -->
    <script src="<?php echo e(asset('frontend/product-slider/js/main.min.js')); ?>"></script>
<script>
    $(function(){
        $('input[name="profile_logo"]').click(function(){
            var $radio = $(this);
            
            // if this was previously checked
            if ($radio.data('waschecked') == true)
            {
                $radio.prop('checked', false);
                $radio.data('waschecked', false);
            }
            else
                $radio.data('waschecked', true);
            
            // remove was checked from other radios
            $radio.siblings('input[name="rad"]').data('waschecked', false);
        });
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/company/single-product.blade.php ENDPATH**/ ?>