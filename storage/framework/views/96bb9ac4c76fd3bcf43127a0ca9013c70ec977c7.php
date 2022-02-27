<header class="header d-flex justify-content-between align-items-center sticky-top">
    <div class="head-left d-flex align-items-center">
        <a href="#" class="logo"><img src="<?php echo e(asset('frontend/assets/img/sortiment-logo.png')); ?>" alt="logo"></a>
        <div class="search">
            <a href="#" class="search-icon"><img src="<?php echo e(asset('frontend/assets/img/search-solid.png')); ?>" alt="search"></a>
            <input type="text" class="form-control" placeholder="Search for a product…">
        </div>
    </div><!-- Header left -->
    <div class="head-right d-flex align-items-center">
        <div class="minicart">

            <a href="javascript:void(0);" class="cart-icon" id="cart_popup">
                <span>
                    <img src="<?php echo e(asset('frontend/assets/img/shopping-cart-solid.png')); ?>" alt="">
                    <small class="cart-badge"><?php echo e(Cart::count()); ?></small>
                </span>
                <small class="carttext"><?php echo e(Cart::total()); ?> DKK In cart</small>
            </a>
        </div><!-- Minicart -->
        <!-- shopping-cart -->
        <div class="shopping-cart" style="display: none;">
            <div class="close-cart"> <i class="fa fa-times"></i></div>
            <div class="shopping-cart-header">
                <i class="fa fa-shopping-cart cart-icon"></i><span class="badge"><?php echo e(Cart::count()); ?></span>
                <div class="shopping-cart-total">
                    <div class="shop">&nbsp;</div>
                <span class="lighter-text">Total:</span>
                <span class="main-color-text"><?php echo e(Cart::total()); ?></span>


                </div>
            </div> <!--end shopping-cart-header -->

            <ul class="shopping-cart-items">
              <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="clearfix">
                <a href="#"><img src="<?php echo e(asset(($row->options->has('image') ? $row->options->image : ''))); ?>" alt="item1" /></a>
                <a href="#">
                    <span class="item-name"><?php echo e($row->name); ?></span>
                    <span class="item-price"><?php echo e($row->price); ?></span>
                    <span class="item-quantity">Quantity: <?php echo e($row->qty); ?></span>
                </a>
                <div class="remove-trash"> <a href="<?php echo e(route('cart.delete')); ?>"><i class="fa fa-trash"></i></a></div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php if(Cart::content()->count()>0): ?>
            <div class="checkout-btn">
                <a href="<?php echo e(route('view.cart')); ?>" class="button">Checkout</a>
            </div>
            <?php endif; ?>
        </div> <!--end shopping-cart -->
        <?php
			$userData=DB::table('users')->find(Auth::user()->id);
            $name=explode(' ',$userData->name)
		  ?>
        <div class="head-user-name">
            <a href="#">
                <span class="username">Welcome “<?php echo e($name[0]); ?>”</span>
                <img class="user-img" src="<?php echo e(asset($userData->profile_photo_path?$userData->profile_photo_path:'frontend/assets/img/user-img.png')); ?>" width="50px" alt="user picture">
            </a>
        </div><!-- Head user name -->
    </div><!-- Header right -->
</header><!-- Header -->
<?php /**PATH /var/www/html/sortiment/resources/views/company/body/header.blade.php ENDPATH**/ ?>