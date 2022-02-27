<?php $__env->startSection('content'); ?>

<div class="cart-wrap shadow-box p-40">
    <div class="row">
        <div class="col-md-8">
            <div class="page-title">
                <h1><img src="<?php echo e(asset('frontend/assets/img/shopping-cart-solid.png')); ?>" alt=""> Cart</h1>
            </div><!-- Page title -->
            <div class="cart-table table-responsive ptb-45">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="product-name d-flex align-items-center">
                                <img src="<?php echo e(asset(($row->options->has('image') ? $row->options->image : ''))); ?>" alt="">
                                <h5><a href="#"><?php echo e($row->name); ?></a> <small class="small-text">Product category</small></h5>
                            </div>
                        </td>
                        <td>
                            <div class="qty">
                                <a href="<?php echo e(url('/company/cart/update/'.$row->rowId.'/minus')); ?>" class="qty-dec"><i class="fas fa-minus"></i></a>
                                <input type="text" class="qty-input" placeholder="0" value="<?php echo e($row->qty); ?>">
                                <a href="<?php echo e(url('/company/cart/update/'.$row->rowId.'/plus')); ?>" class="qty-inc"><i class="fas fa-plus"></i></a>
                            </div>
                        </td>
                        <td><?php echo e($row->price); ?> DKK</td>
                        <td><a href="<?php echo e(route('cart.delete')); ?>" class="delete"><i class="fas fa-times"></i></a> </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </table>
                <div class="btn-row d-flex justify-content-center align-items-center">
                    <a href="#" class="btn btn-blue">Write product information yourself</a>
                    <span>OR</span>
                    <a href="#" class="btn btn-outline">Let employees choose</a>
                </div><!-- Button row -->
            </div><!-- Cart table -->
            <div class="cart-prod-info">
                <div class="top-tab">
                    <span class="seleccted">Upload name list</span>
                    <span>Upload your excel name list by clicking the button</span>
                </div><!-- top tab-->
                <div class="cart-items-table table-responsive">
                    <table  class="table">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php for($count = 1; $count <= $product['qty']; $count ++): ?>
                                <tr>
                                    <td>
                                        <input type="text" placeholder="Write name label" class="form-control">
                                    </td>
                                    <?php $__currentLoopData = $product['attributes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attribute): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td>
                                            <select name="product_attribute[<?php echo e($attribute['attribute_id']); ?>]" id="product-attribute-<?php echo e($attribute['attribute_id']); ?>" class="form-select">
                                                <option value="">Choose <?php echo e($attribute['name']); ?></option>
                                                <?php $__currentLoopData = $attribute['values']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($value['attribute_value_id']); ?>"><?php echo e($value['value']); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </td>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <td>
                                        <div class="cart-qty d-flex align-items-center">
                                            <input type="text" placeholder="1" class="form-control">
                                            <span>Quantity</span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="delete"><i class="fas fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </table>
                </div><!-- Cart items table -->
            </div><!-- Cart product information -->
        </div><!-- Col -->
        <aside class="col-md-4">
            <div class="shadow-box user-info-form">
                <h4>Your information</h4>
                <form action="" class="form">
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Name" class="form-control" value="<?php echo e(Auth::user()->name); ?>">
                        <span class="requ">*</span>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Email" class="form-control" value="<?php echo e(Auth::user()->email); ?>">
                        <span class="requ">*</span>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Phone number" class="form-control">
                        <span class="requ">*</span>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Company name" class="form-control">
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Postal code" class="form-control">
                        <span class="requ">*</span>
                    </div>
                    <div class="form-group mb-3">
                        <input type="text" placeholder="Address" class="form-control">
                        <span class="requ">*</span>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="btn btn-blue">Next</button>
                    </div>
                </form>
            </div><!-- user info form -->
        </aside><!-- Col -->
    </div>
</div><!-- Cart wrap  -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/company/cart.blade.php ENDPATH**/ ?>