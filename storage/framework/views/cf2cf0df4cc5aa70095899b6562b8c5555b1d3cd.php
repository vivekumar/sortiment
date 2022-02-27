<?php $__env->startSection('content'); ?>
    <div class="single-product shadow-box">
        <div class="back-btn">
            <a href="<?php echo e(route('emp.shop')); ?>"><i class="bi bi-arrow-left-short"></i> Tilbage</a>
        </div><!-- Back button -->

        <div class="row">
            <div class="col-lg-7 col-md-12">
                <!--img-products-->
                <?php $mutimages=DB::table('customize_multimgs')->where('customize_product_id',$product->product_id)->get(); ?>
                <div class="img-products">
                    <div class="owl-carousel owl-theme big" id="big">
                        <div class="item">
                            <figure class="zoom" onmousemove="zoom(event)" style="background-image: url(<?php echo e(asset($product->product_thambnail)); ?>)">
                                <img src="<?php echo e(asset($product->product_thambnail)); ?>" />
                            </figure>
                        </div>
                        <?php $__currentLoopData = $mutimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mutimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <?php $__currentLoopData = $mutimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mutimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="item">
                                <img alt="" class="img-responsive" src="<?php echo e(asset($mutimage->photo_name)); ?>"/>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div><!--/thumbs-->
                </div><!--/img-products-->


            </div>
            <div class="col-lg-5 col-md-12">
            <?php if(session()->has('message')): ?>
                <div class="alert alert-success">
                    <?php echo e(session()->get('message')); ?>

                </div>
            <?php endif; ?>
                <div class="product-info">
                    <h1><?php echo e($product->product_name); ?></h1>
                    <div class="select-product-type">
                        <?php if($product->status=='pending'): ?>
                        <form action="<?php echo e(route('emp.post')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="order_emp_id" value="<?php echo e($product->id); ?>">
                            <input type="hidden" name="employee_id" value="<?php echo e($product->employee_id); ?>">
                            <input type="hidden" name="product_name" value="<?php echo e($product->product_name); ?>">


                            <input type="hidden" name="product_thambnail" value="<?php echo e($product->product_thambnail); ?>">
                            <?php if($product->name_on_product=='yes'): ?>
                            <div class="form-group">
                                <input type="text" class="form-control" name="label" placeholder="<?php echo e(__('Write name label')); ?>" required>
                            </div>
                            <?php endif; ?>
                            <?php $distincts = DB::table('customize_product_attributes')->distinct()->select('attribute_id')->where('product_id', '=',$product->product_id)->get();
                            ?>


                            <?php $__currentLoopData = $distincts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distinct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $attributs=DB::table('customize_product_attributes')->where('product_id',$product->product_id)->where('attribute_id',$distinct->attribute_id)->get();?>
                                <div class="form-group"><select name="<?php echo e(\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name')); ?>" class="form-control" required><option value=""><?php echo e(__('Choose')); ?> <?php echo e(__(\App\Models\Attribute::where('id',$distinct->attribute_id)->value('attr_name'))); ?></option>

                                <?php $atttt=[];?>
                                <?php $__currentLoopData = $attributs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$attribut): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                    $ddddd=\App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_value');
                                    $atttt[$ddddd]=\App\Models\AttributeValue::where('id',$attribut->attrvalue_id)->value('attr_order');
                                    ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                asort($atttt);
                                ?>

                                <?php $__currentLoopData = $atttt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key11=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($key11); ?>"><?php echo e($key11); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                
                                </select></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                            <div class="form-group">
                                <button class="btn btn-blue"><?php echo e(__('Approve')); ?></button>
                            </div>
                        </form>
                        <?php else: ?>
                        <button class="btn btn-success"><?php echo e(__('Approve')); ?></button>
                        <?php endif; ?>
                    </div>
                </div><!-- Product info -->
            </div>
        </div>
    </div><!-- Single product -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/employee/employees-single-product.blade.php ENDPATH**/ ?>