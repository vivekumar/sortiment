<?php $__env->startSection('content'); ?>


<div class="welcom-popup shadow-box text-center">
    <a href="#" class="round-btn" onClick="$(this).parent().remove()"><i class="bi bi-x-lg"></i></a>
    <h1><?php echo e(__('Welcome to the shop')); ?></h1>
    <p><?php echo e(__('Here you can see all of our products click on any of them to get the right price just for you!')); ?></p>
</div><!-- Welcom popup -->
<section class="product-filter-sec ptb-45">
    <div class="filters">
        <form class="row g-3" method="get" action="">
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select" name="category" onchange="submitfilter()">
                        <option value=""><?php echo e(__('Category')); ?></option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php if( request()->get('category')==$category->id): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e($category->category_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div><!-- Col -->
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select name="subcategory" class="form-control" class="subcategory_id" id="subcategory_id" onchange="submitfilter()">
                        <option value="" selected="" ><?php echo e(__('Select SubCategory')); ?></option>
                        <?php if(!empty($subcategory)): ?>
                            <?php $__currentLoopData = $subcategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($scategory->id); ?>" <?php if( request()->get('subcategory')==$scategory->id): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e($scategory->subcategory_name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </select>

                </div>
            </div> <!-- end col md 4 -->
            <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select" name="brand" onchange="submitfilter()">
                        <option  value=""><?php echo e(__('Brand')); ?> </option>
                        <?php $__currentLoopData = $brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($brand->id); ?>" <?php if( request()->get('brand')==$brand->id): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e($brand->brand_name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div><!-- Col -->
            <?php $i=0;

            if( request()->get('attribute')){
                $attrib=request()->get('attribute');
            }
            ?>
            <?php $__currentLoopData = $attributes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($attribute->attr_name=="Color"): ?>


           <!-- =============BackUp Code Start 26-10-2021============== -->

         <!--    <div class="col-lg-3 col-md-6">
                <div class="select">
                    <select class="form-select" name="attribute[<?php echo e($attribute->id); ?>][]" onchange="submitfilter()">
                        <option  value="">---<?php echo e(__($attribute->attr_name)); ?>---</option>
                        <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attrValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($attrValue->id); ?>" <?php if( @$attrib[$attribute->id][0]==$attrValue->id): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e($attrValue->attr_value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div> -->

         <!-- =============BackUp Code End 26-10-2021============== -->

             <div class="col-lg-3 col-md-6">
                <div class="dropdown custom-color-dropdown">
                    <input type="hidden" name="attribute[<?php echo e($attribute->id); ?>][]" id="attrvvv">

                    <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                    <?php echo e(__($attribute->attr_name)); ?>

                    </button>
                    <ul class="dropdown-menu">
                        <?php //array_unique($attribute->values) ?>
                        <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attrValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><a class="dropdown-item" href="#" style="background-color:<?php echo e($attrValue->attr_code); ?>" onclick="colorarr(this,<?php echo e($attrValue->id); ?>)"></a></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>



                   <!--  <select class="form-select" name="attribute[<?php echo e($attribute->id); ?>][]" onchange="submitfilter()">
                        <option  value="">---<?php echo e(__($attribute->attr_name)); ?>---</option>
                        <?php $__currentLoopData = $attribute->values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attrValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($attrValue->id); ?>" <?php if( @$attrib[$attribute->id][0]==$attrValue->id): ?><?php echo e('selected'); ?> <?php endif; ?>><?php echo e($attrValue->attr_value); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select> -->
                <!-- </div> -->
            </div>

            <!-- Col -->



            <?php endif; ?>
            <?php $i=$i+1; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </form><!-- Filter form -->
    </div><!-- Filters -->
</section><!-- Product Filter -->

<section class="row product-items d-flex justify-content-between1 ">
    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="col-md-3">
    <div class="product-item shadow-box text-center">
        <a href="<?php echo e(route('product.detail',$product->id)); ?>" class="product-img"><img src="<?php echo e(asset($product->product_thambnail)); ?>" alt="Product"></a>
        <h5><a href="#"><?php echo e($product->product_name); ?></a></h5>
        <p class="price"><?php echo e(__('Request a price')); ?></p>
    </div><!-- Product item -->
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</section><!-- Product items -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
    function submitfilter(){
        $("form").submit();
    }
    function colorarr(that,id){
        $('#attrvvv').val(id);
        $("form").submit();
    }
</script>
<script>
$(document).ready(function() {

    $('select[name="category_id"]').on('change', function(){
        var category_id = $(this).val();
        if(category_id) {
            $.ajax({
                url: "<?php echo e(url('/category/subcategory/ajax')); ?>/"+category_id,
                type:"GET",
                //dataType:"json",
                success:function(data) {
                    if(data){
                        console.log(data);
                        $("#subcategory_id").empty();
                        $("#subcategory_id").append('<option value="">---- Select Subcategory---</option>');
                            $.each(data,function(key,value){
                                console.log(value.subcategory_name);
                            $("#subcategory_id").append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                            });
                            console.log($("#subcategory_id"));
                        }else{
                            $("#subcategory_id").empty();
                        }
                    //$('.subcategory').html(data);

                    //$("#subcategory_id").niceSelect('update');
                    //$("#subcategory_id").niceSelect('refresh');
                },
            });
        } else {
            alert('danger');
        }
    });

});

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/company/index.blade.php ENDPATH**/ ?>