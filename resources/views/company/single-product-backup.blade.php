@extends('company.main_master')
@section('css')
<style>
    .hide{display:none;}
    .show{display:block;}
    .products-con{z-index: 9;}
    #imgPopup_modal .modal-dialog {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
</style>
@endsection
@section('content')
<div class="single-product shadow-box">
    <div class="back-btn">
        <a href="{{route('dashboard')}}"><i class="bi bi-arrow-left-short"></i> Tilbage</a>
    </div><!-- Back button -->
    <div class="row">

        <div class="col-lg-7 col-md-12">
           <!-- =============Product Zoom Effect Code Start=============== -->
                         <div class="img-products">
                                 <!-- <a href="#" id="ask-price-btn" class="btn btn-blue modal-btn" data-bs-toggle="modal" data-bs-target="#product-zoom-model">
                                   <i class="fas fa-search-plus"></i>
                                </a> -->
                                <div class="owl-carousel owl-theme big" id="big">
                                    <div class="item">
                                        <img alt="" id="ask-price-btn" data-bs-toggle="modal" data-bs-target="#product-zoom-model" class="img-responsive modal-btn" data-lightbox="gallery"
                                             src="{{asset($product->product_thambnail) }}"/>
                                    </div>
                                    @foreach($product->mutimage as $mutimage)
                                    <div class="item">
                                        <img id="ask-price-btn" class="modal-btn" data-bs-toggle="modal" data-bs-target="#product-zoom-model" src="{{asset($mutimage->photo_name) }}" />
                                    </div>
                                    @endforeach
                                </div>
                                <div class="owl-carousel owl-theme" id="thumbs">
                                    <div class="item">
                                        <img alt="" class="img-responsive" data-lightbox="gallery"
                                             src="{{asset($product->product_thambnail) }}"/>
                                    </div>
                                    @foreach($product->mutimage as $mutimage)
                                    <div class="item">
                                        <img src="{{asset($mutimage->photo_name) }}" />
                                    </div>
                                    @endforeach
                                </div>
                            </div>
           <!-- =============Product Zoom Effect Code ENd=============== -->



            <!--img-products-->
            <!-- <div class="img-products">
                <div class="owl-carousel owl-theme big" id="big">
                    <div class="item">
                        <figure onclick="showbig(this,'{{asset($product->product_thambnail) }}')" class="zoom modal-btn" onmousemove="zoom(event)" style="background-image: url({{asset($product->product_thambnail) }})">
                            <img src="{{asset($product->product_thambnail) }}" />
                        </figure>
                    </div>
                    @foreach($product->mutimage as $mutimage)
                    <div class="item">
                        <figure onclick="showbig(this,'{{asset($mutimage->photo_name) }}')" class="zoom modal-btn" onmousemove="zoom(event)" style="background-image: url({{asset($mutimage->photo_name) }})">
                            <img src="{{asset($mutimage->photo_name) }}" />
                        </figure>
                    </div>
                    @endforeach
                </div>
                <div class="owl-carousel owl-theme" id="thumbs">
                    <div class="item">
                        <img alt="" class="img-responsive" src="{{asset($product->product_thambnail) }}"/>
                    </div>
                    @foreach($product->mutimage as $mutimage)
                        <div class="item">
                            <img alt="" class="img-responsive" src="{{asset($mutimage->photo_name) }}"/>
                        </div>
                    @endforeach
                </div>
            </div> -->
        </div>

<!-- =========Model Code Start============ -->
<!--
<div class="main">
<img id="map" src="http://www.worldatlas.com/webimage/countrys/europelargesm.jpg" />
</div> -->
                    <div class="modal fade" id="product-zoom-model" role="dialog" aria-labelledby="priceModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content">
              <div class="modal-body">
                <div class="close" data-dismiss="modal">
                    <button type="button" class="btn-close round-btn" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <div class="owl-carousel owl-theme big" id="big-popup">
                    <div class="item">
                        <img  alt="" class="img-responsive _9gag" data-lightbox="gallery"
                             src="{{asset($product->product_thambnail) }}"/>
                    </div>
                    @foreach($product->mutimage as $mutimage)
                    <div class="item">
                        <img class="_9gag" src="{{asset($mutimage->photo_name) }}" />
                    </div>
                    @endforeach
                </div>

<!-- =============Zoom Button Code Start============= -->
<div class="text-center">
 <button id="zoomIn" class="btn btn-blue"><i class="fas fa-search-plus"></i></button>
      <button id="zoomOut" class="btn btn-danger"><i class="fas fa-search-minus"></i></button>
</div>
<!-- =============Zoom Button Code End============= -->
            </div>
                        </div>
                        </div>
                    </div>

<!-- =========Model Code Start============ -->
        <div class="col-lg-5 col-md-12">
            <div class="product-info">
                <h1>{{$product->product_name}}</h1>
                <div class="price">Pris fra: DKK {{round($product->product_price)}},- </div>
                <div class="product-description">
                    <h3>Produkt beskrivelse</h3>
                    <div>{!!$product->description!!}</div>
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
                            <ul class="d-flex '.$att.'">';
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
                @if(!empty($product->product_pdf))
                <div class="download-pdf text-center">
                    <a href="{{asset($product->product_pdf)}}" target="__blank" download>{{__('Download produkt info')}} <i class="far fa-file-pdf"></i></a>
                </div><!-- Download Pdf -->
                @endif
            </div><!-- Product info -->
        </div>
    </div>
</div><!-- Single product -->
<!-- Modal -->
<div class="modal fade" id="priceModal" role="dialog" aria-labelledby="priceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="priceModalLabel"><strong>{{__('Get a price for')}}:</strong> {{$product->product_name}}</h5>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form action="" id="upload_form" method="post" class="price-form" enctype="multipart/form-data">
            @csrf
                <div class="form-row mb-3 ">
                    <div class="row form-group">
                        <label for="" class="col-md-6 col-sm-12 col-form-label">{{__('Do you want your logo on the product')}}?</label>
                        <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                            <label for="noRadio">
                                <input class="form-check-input" id="noRadio" type="radio" name="logo_on_product" value="0"> {{__('No')}}
                            </label>
                            <label for="yesRadio">
                                <input class="form-check-input" id="yesRadio" type="radio" name="logo_on_product" value="1"> {{__('Yes')}}
                            </label>
                        </div><!-- filed group -->
                    </div><!-- Form group -->
                    <div class="row form-group logoOnP hide">
                        <label for="" class="col-md-6 col-sm-12 col-form-label">{{__('Where do you want your logo position')}}?</label>
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
                        <label for="" class="col-md-6 col-sm-12 col-form-label">{{__('Do you want to assign a text to the product')}}?</label>
                        <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                            <label for="noRadio2">
                                <input class="form-check-input" id="noRadio2" type="radio" name="text_on_product" value="0"> {{__('No')}}
                            </label>
                            <label for="yesRadio2">
                                <input class="form-check-input" id="yesRadio2" type="radio" name="text_on_product" value="1"> {{__('Yes')}}
                            </label>
                        </div><!-- filed group -->
                    </div><!-- Form group -->
                    <div class="row form-group textOnP hide" >
                        <label for="" class="col-md-6 col-sm-12 col-form-label">{{__('Where do you want your text position')}}?</label>
                        <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                            <div class="form-check d-flex flex-wrap">
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check01" name="text_front_left" value="Front left">
                                    <label class="form-check-label" for="check01">
                                        Front left
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check02" name="text_front_right" value="Front right">
                                    <label class="form-check-label" for="check02">
                                        Front right
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check03" name="text_shoulder_left" value="Shoulder left">
                                    <label class="form-check-label" for="check03">
                                        Shoulder left
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check04" name="text_shoulder_right" value="Shoulder right">
                                    <label class="form-check-label" for="check04">
                                        Shoulder right
                                    </label>
                                </div><!-- div -->
                                <div class="d-flex align-items-center col-md-6">
                                    <input class="form-check-input" type="checkbox" id="check05" name="text_onthe_back_side" value="On the backside">
                                    <label class="form-check-label" for="check05">
                                        On the backside
                                    </label>
                                </div><!-- div -->
                            </div>
                        </div><!-- filed group -->
                    </div><!-- Form group -->
                </div><!-- form row -->
                <div class="form-group mb-3 upload-logo">
                    <div class="sec_logo">
                        <div class="upload_logo">
                            <button type="button" id="btnup" class="upload-btn d-flex align-items-center">
                            <img src="{{asset('frontend/assets/img/upload-icon.png') }}" class="upload-icon" alt="">
                            <p id="namefile" class="">
                                <strong>{{__('Upload your logo')}} <small class="d-flex">{{__('Allowed files')}}: EPS,JPG, PNG, AI, SVG & PDF</small></strong>
                            </p>
                            </button>
                            <input type="file" value="" name="logo" id="fileup">
                        </div>
                        <div class="sec-logo-flex">
                            @foreach($allimages as $allimage)
                            <div class="custom_logo">
                                <input type="radio" name="profile_logo" id="cb{{$allimage->id}}" value="{{$allimage->image}}" />
                                <label for="cb{{$allimage->id}}">
                                    <img src="{{asset($allimage->image) }}" />
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div><!-- Upload logo-->
                <div class="form-group mb-3">
                    <textarea name="message" id="message" cols="" rows="" class="form-control" placeholder="{{__('Leave a note, with further information about your acquirements')}}."></textarea>
                </div><!-- row-->
                <div class="form-group">
                    <button type="submit" id="RequestPrice" class="btn btn-blue f-width">Send forspørgsel</button>
                </div><!-- row-->
                <input type="hidden" name="product_id" value="{{$product->id}}">
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


@endsection
@section('js')
<script>
/*=====================================================================
===================== Product-Slider-with-zoom start Code 21-10-2021 =================
========================================================================*/
$(document).ready(function () {
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
            items: 3,
            dots: true,
            nav: true,
            navText: [
                '<i class="bi bi-arrow-left-short"></i>',
                '<i class="bi bi-arrow-left-short"></i>'
            ],
            autoplay: false,
            smartSpeed: 2000000,
            slideSpeed: 5000000,
            slideBy: 3,
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
      /**
       * ดูตำแหน่ง x,y จากเว็บนี้ได้ https://css-tricks.com/examples/AnythingZoomer/image.php
       */
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
   * @img ชื่อ class หรือ id
   */
  this.zoomOut = function(img){

        $(img).removeAttr("style");

    };

  /**
   * @img ชื่อ .class หรือ #id
   * @scale ระดับการ zoom
   * @xNew ตำแหน่ง x ที่เริ่ม zoom
   * @yNew ตำแหน่ง y ที่เริ่ม zoom
   * @xImage ตำแหน่ง x ที่จะซูม
   * @yImage ตำแหน่ง y ที่จะซูม
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
                url:"{{ route('priceRequest') }}",
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
@endsection
