<?php $__env->startSection('css'); ?>
<style>
    .products-con div#namListModal .modal-dialog {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%,-50%);
    }
    div#namListModal .modal-body {
        text-align: center;
    }

    div#namListModal .modal-body a.download-sample {
        font-size: 20px;
        color: #3020d1;
        font-weight: 600;
    }
</style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="cart-wrap shadow-box p-40">
<form action="<?php echo e(route('checkout')); ?>" class="form" method="post">
    <?php echo csrf_field(); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="page-title">
                <h1><img src="<?php echo e(asset('frontend/assets/img/shopping-cart-solid.png')); ?>" alt=""> <?php echo e(__('Cart')); ?></h1>
            </div><!-- Page title -->
            <?php $i=0; ?>

            <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key11=>$row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <div class="cart-table table-responsive ptb-45">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"><?php echo e(__('Product')); ?></th>
                            <th scope="col"><?php echo e(__('Quantity')); ?></th>
                            <th scope="col"><?php echo e(__('Price')); ?></th>
                            <th scope="col">&nbsp;</th>
                        </tr>
                    </thead>

                    <tr>
                        <td scope="row" data-label="<?php echo e(__('Product')); ?>">
                            <div class="product-name d-flex align-items-center">
                                <img src="<?php echo e(asset(($row->options->has('image') ? $row->options->image : ''))); ?>" alt="" style="width:100px; height:auto">
                                <h5><a href="#"><?php echo e($row->name); ?></a> <small class="small-text"></small></h5>
                            </div>
                        </td>
                        <td data-label="<?php echo e(__('Quantity')); ?>">
                            <div class="qty">
                                <a href="<?php echo e(url('/company/cart/update/'.$row->rowId.'/minus')); ?>" class="qty-dec"><i class="fas fa-minus"></i></a>
                                <input type="text" name="cartQty" class="qty-input" placeholder="0" value="<?php echo e($row->qty); ?>">
                                <a href="<?php echo e(url('/company/cart/update/'.$row->rowId.'/plus')); ?>" class="qty-inc"><i class="fas fa-plus"></i></a>
                            </div>
                        </td>
                        <td data-label="<?php echo e(__('Price')); ?>"><?php echo e($row->price); ?> DKK</td>
                        <td data-label="Slet"><a href="<?php echo e(route('cart.delete',$row->rowId)); ?>" class="delete"><i class="fas fa-times"></i></a> </td>
                    </tr>

                </table>
                <div class="btn-group-sm float-end"><button type="button" class="btn btn-blue  btn-sm" onclick="updateCart('<?php echo e($row->rowId); ?>',this)"><?php echo e(__('Update cart')); ?></button></div>

            </div><!-- Cart table -->

            <ul class="tabs btn-row d-flex justify-content-center align-items-center pb-45">
                <li class="btn btn-tabs active-tab"><a href="<?php echo e(route('view.cart')); ?>" data-or="eller"><?php echo e(__('Write product information yourself')); ?></a></li>

                <li class="btn btn-tabs"><a href="<?php echo e(route('view.cart1')); ?>"><?php echo e(__('Let employees choose')); ?></a></li>
            </ul><!-- Button row -->




            <ul class="tabs-content1 cart-prod-info">
                <li>
                    <div class="top-tab">

                    <?php if($products[$i]['name_on_product']=="yes"): ?><span class="seleccted"><?php echo e(__('Upload name list')); ?></span><?php endif; ?>
                    <?php if(count($products[$i]['attributes'])>0 || $products[$i]['name_on_product']=="yes"): ?>
                        <span><a href="javascript:void(0);" data-bs-toggle="modal1" data-bs-target="#excelModal1" class="modal-btn" onclick="namelistModel('<?php echo e($row->id); ?>',this)"><?php echo e(__('Upload your excel name list by clicking the button')); ?></a></span>

                    <?php endif; ?>
                    </div><!-- top tab-->
                    <div class="cart-items-table table-responsive">
                        <table  class="table table<?php echo e($row->id); ?>">

                            <?php
                            $product=$products[$i];

                            ?>
                            
                                <?php for($count = 1; $count <= $product['qty']; $count ++): ?>
                                    <tr>
                                        <?php if($product['name_on_product']=="yes"): ?>
                                        <td class="tlabel">
                                            <input type="text" name="lable[<?php echo e($row->id); ?>][]" placeholder="<?php echo e(__('Write name label')); ?>" class="form-control" required>
                                        </td>
                                        <?php endif; ?>
                                        <?php $__currentLoopData = $product['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <td class="t<?php echo e($attribute['name']); ?>">
                                                <select name="product_attribute[<?php echo e($row->id); ?>][<?php echo e($attribute['attribute_id']); ?>][]" id="product-attribute-<?php echo e($attribute['attribute_id']); ?>" class="form-select" required>
                                                    <option value=""><?php echo e(__('Choose')); ?> <?php echo e(__($attribute['name'])); ?></option>

                                                    <?php $atttt=[];?>
                                                    <?php $__currentLoopData = $attribute['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attribut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php
                                                        $atttt[$attribut['value']]=\App\Models\AttributeValue::where('id',$attribut['attribute_value_id'])->value('attr_order');
                                                        ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php
                                                    asort($atttt);
                                                    ?>

                                                    <?php $__currentLoopData = $atttt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key11=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key11); ?>"><?php echo e($key11); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                    
                                                </select>
                                            </td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <td class="tqty">
                                            <div class="cart-qty d-flex align-items-center">
                                                <input type="text" value="1" class="form-control" name="qty[<?php echo e($row->id); ?>][]" required>
                                                <span><?php echo e(__('Quantity')); ?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#" class="delete" onclick="confirm('Are you sure?') ? $(this).parent().parent().remove() : false"><i class="fas fa-times"></i></a>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
                            

                        </table>
                    </div><!-- Cart items table -->
                </li>


                
            </ul><!-- Cart product information -->


            

            <?php $i=$i+1; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if(count(Cart::content()) <= 0): ?>
                Product not found
            <?php endif; ?>



        </div><!-- Col -->
        <aside class="col-md-4">
            <div class="shadow-box user-info-form">
                <h4><?php echo e(__('Your information')); ?></h4>

                    <div class="form-group mb-3">
                        <input type="text" placeholder="<?php echo e(__('Name')); ?>" class="form-control" value="<?php echo e(Auth::user()->name); ?>" name="name">
                        <span class="requ">*</span>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-tenger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="<?php echo e(__('Email')); ?>" class="form-control" value="<?php echo e(Auth::user()->email); ?>" name="email">
                        <span class="requ">*</span>
                        <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-tenger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="<?php echo e(__('Phone number')); ?>" class="form-control" value="<?php echo e(Auth::user()->phone); ?>" name="phone">
                        <span class="requ">*</span>
                        <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-tenger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="<?php echo e(__('Company name')); ?>" class="form-control" value="<?php echo e(Auth::user()->company); ?>" name="company">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="<?php echo e(__('Postal code')); ?>" class="form-control" value="<?php echo e(Auth::user()->zip); ?>" name="zip">
                        <span class="requ">*</span>
                        <?php $__errorArgs = ['zip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-tenger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="<?php echo e(__('Address')); ?>" class="form-control" value="<?php echo e(Auth::user()->address); ?>" name="address">
                        <span class="requ">*</span>
                        <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <span class="text-tenger"><?php echo e($message); ?></span>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-blue"><?php echo e(__('Next')); ?></button>
                    </div>

            </div><!-- user info form -->
        </aside><!-- Col -->
    </div>
    </form>
</div><!-- Cart wrap  -->


<div class="modal fade pop-bottom" id="namListModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="excelModalLabel"><strong>
        <?php echo e(__('Import name list using Execel')); ?></strong></h5>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close" onclick="closeModel()"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <a href="<?php echo e(asset('/public/uploads/excel/Mappe1.xlsx')); ?>" class="download-sample" download><?php echo e(__('Download sample data')); ?></a>
            <form action="" class="price-form">
                <div id="errors"></div>
                <div class="company-info">
                    <div class="form-group mb-3 upload-logo">
                        <button type="button" id="btnup" class="upload-btn">
                            <p id="namefile" class=""><?php echo e(__('upload a file')); ?></p>
                            <img src="<?php echo e(asset('frontend/assets/img/upload-icon.png')); ?>" class="upload-icon" alt="">
                        </button>
                        <input type="file" value="" name="fileup" id="fileup">
                        <input type="hidden" pid="" id="pid">
                    </div><!-- row-->
                    <div id="responseMsg" ></div>
                    <div class='alert alert-danger mt-2 d-none text-danger' id="err_file"></div>
                    <div class="form-group">
                        <button type="button" id="submit" class="btn btn-blue f-width"><?php echo e(__('Upload Excel file')); ?></button>
                    </div>
                </div>
            </form><!-- Price form-->
        </div>
    </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
function updateCart(rowid,that) {
    var item_qty=$(that).parent().parent().find('input').val();
    console.log(item_qty);
    $.ajax({
        url: "<?php echo e(url('/')); ?>/company/cart/updatebulk/"+rowid+"/"+item_qty,
        method: 'get',
        data: item_qty,
        contentType: false,
        processData: false,
        //dataType: 'json',
        success: function(response){
            location.reload();
            //window.location.reload();
        },
    });
}
</script>

<script>

function namelistModel(id,that){
    $('#namListModal').removeClass('fade');
    $('.products-con').append('<div class="modal-backdrop fade show"></div>');
    $("#pid").val(id);
    $('#namListModal').show();
    $(window).scrollTop(0);
}
function closeModel(){
    $('#namListModal').addClass('fade');
    $('.modal-backdrop').remove();

    $('#namListModal').hide();
}

  var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

  $(document).ready(function(){
    //$('.table4 > tbody > tr:nth-child(2) > td:eq(0) input', this).val('vivek');

    //$('.table4 > tbody > tr:nth-child(1) > td.tColor select option[value="White"]').prop('selected', true);

    $('#submit').click(function(){
        console.log('ewrwe');
      // Get the selected file
      var files = $('#fileup')[0].files;

      if(files.length > 0){
         var fd = new FormData();

         // Append data
         fd.append('file',files[0]);
         fd.append('_token',CSRF_TOKEN);
         fd.append('pid',$("#pid").val());
         // Hide alert
         $('#responseMsg').hide();

         // AJAX request
         $.ajax({
           url: "<?php echo e(route('uploadList')); ?>",
           method: 'post',
           data: fd,
           contentType: false,
           processData: false,
           dataType: 'json',
           success: function(response){
            $("#errors").html('');
             // Hide error container
             $('#err_file').removeClass('d-block');
             $('#err_file').addClass('d-none');
                console.log(response);
             if(response.success == 1){ // Uploaded successfully

                /*$(".table"+response.pid+" > tbody > tr").each(function(){
                    var productVal = $('td:eq(0) input', this).val('ewwe');
                });*/
                // var label1 = response.data[0][0];
                // var size1 = response.data[0][1];
                // var color1 = response.data[0][2];
                // var qtyyy1 = response.data[0][3];

                $.each( response.data, function( key, cdata1 ) {
                    //console.log(cdata1[1]);
                    console.log(cdata1);
                    //var ar[] = cdata1[0]

                    if(key>0){
                        //coldata = cdata1.split(",");
                   // console.log(coldata[0]);
                    //$('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td:eq(0) input').val(cdata1);
                        if(response.label=="yes"){

                            $('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tlabel input').val(cdata1[0]);
                        }
                        if(response.Size){
                            //console.log('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tSize select option[value="'+cdata1[1]+'"]');
                            $('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tSize select option[value="'+cdata1[1]+'"]').prop("selected", true);
                            //$('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tSize select').val(cdata1[1]).change();
                        }
                        if(response.Color){
                            //console.log('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tColor select option[value="'+cdata1[2]+'"]');
                            $('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td.tColor select option[value="'+cdata1[2]+'"]').prop("selected", true);
                        }
                        $('.table'+response.pid+' > tbody > tr:nth-child('+key+') > td:eq(3) input').val(cdata1[3]);
                    }

                });

               // Response message
               $('#responseMsg').removeClass("alert alert-danger");
               $('#responseMsg').addClass("alert alert-success");
               $('#responseMsg').html(response.message);
               $('#responseMsg').show();

               // File preview
               $('#filepreview').show();
               $('#filepreview img,#filepreview a').hide();

               setTimeout(() => {
                $('#namListModal').addClass('fade');
                $('.modal-backdrop').remove();
                $('#namListModal').hide();
              }, 1000);

             }else if(response.success == 2){ // File not uploaded

               // Response message
               $('#responseMsg').removeClass("alert alert-success");
               $('#responseMsg').addClass("alert alert-danger");
               $('#responseMsg').html(response.message);
               $('#responseMsg').show();
             }else{
               // Display Error
               $('#err_file').text(response.error);
               $('#err_file').removeClass('d-none');
               $('#err_file').addClass('d-block');
             }
           },
           error: function(xhr, status, errors)
            {
                $('#err_file').text('');
                $('#err_file').removeClass('d-block');
                $('#err_file').addClass('d-none');
                $.each(xhr.responseJSON.errors, function (key, item)
                {
                    $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                });
            },
           /*error: function(response){
              console.log("error : " + JSON.stringify(response) );
           }*/
         });
      }else{
         alert("Please select a file.");
      }

    });
  });
  </script>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/company/cart.blade.php ENDPATH**/ ?>