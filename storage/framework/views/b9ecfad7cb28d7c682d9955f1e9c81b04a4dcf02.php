<header class="header d-flex justify-content-between align-items-center sticky-top">
    <div class="head-left d-flex align-items-center">

        <a href="<?php echo e(url('/')); ?>" class="logo"><img src="<?php echo e(asset('frontend/assets/img/Sortiment logo.svg')); ?>" alt="logo"></a>
        <div class="search">
            <form action="<?php echo e(route('dashboard')); ?>">
                <button type="submit" href="#" class="search-icon"><img src="<?php echo e(asset('frontend/assets/img/search-solid.svg')); ?>" alt="search"></button>
                <input type="text" class="form-control" placeholder="<?php echo e(__('Search for a product')); ?>…" name="s" value="<?php echo e(@$_GET['s']); ?>">
            </form>
        </div>

    </div><!-- Header left -->
    <div class="head-right d-flex align-items-center">
        <div class="minicart">
            <?php
                $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
            ?>
            <a href="javascript:void(0);" class="cart-icon" id="cart_popup">
                <span>
                    <img src="<?php echo e(asset('frontend/assets/img/shopping-cart-solid.svg')); ?>" alt="">
                    <small class="cart-badge"><?php echo e(Cart::count()); ?></small>
                </span>
                <small class="carttext"><?php echo e($formatter->formatCurrency(Cart::total(), 'DKK'), PHP_EOL); ?> <?php echo e(__('In cart')); ?></small>
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
                <span class="main-color-text"><?php echo e($formatter->formatCurrency(Cart::total(), 'DKK'), PHP_EOL); ?></span>


                </div>
            </div> <!--end shopping-cart-header -->

            <ul class="shopping-cart-items">
              <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="clearfix">
                <a href="#"><img src="<?php echo e(asset(($row->options->has('image') ? $row->options->image : ''))); ?>" alt="item1" /></a>
                <a href="#">
                    <span class="item-name"><?php echo e($row->name); ?></span>
                    <span class="item-price"><?php echo e($formatter->formatCurrency($row->price, 'DKK'), PHP_EOL); ?></span>
                    <span class="item-quantity"><?php echo e(__('Quantity')); ?>: <?php echo e($row->qty); ?></span>
                </a>
                <div class="remove-trash"> <a href="<?php echo e(route('cart.delete',$row->rowId)); ?>"><i class="fa fa-trash"></i></a></div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php if(Cart::content()->count()>0): ?>
            <div class="checkout-btn">
                <a href="<?php echo e(route('view.cart')); ?>" class="button">Kasse</a>
            </div>
            <?php endif; ?>
        </div> <!--end shopping-cart -->
        <?php
			//$userData=DB::table('users')->find(Auth::user()->id);
            $name=explode(' ',Auth::user()->name)
		  ?>
        <div class="head-user-name">
            <a href="<?php echo e(route('companyInfo')); ?>">
                <span class="username"><?php echo e(__('Welcome')); ?> <?php echo e($name[0]); ?></span>
                <img class="user-img" src="<?php echo e(asset(Auth::user()->profile_photo_path?Auth::user()->profile_photo_path:'frontend/assets/img/user.png')); ?>" width="50px" alt="user picture">
            </a>
        </div><!-- Head user name -->
    </div><!-- Header right -->

    <!-- burgermenu -->
    <div class="burgermenu">
        <div class="hamburger open">
            <img src="<?php echo e(asset('frontend/assets/img/burgermenu-black.png')); ?>" alt="">
        </div>
    </div><!-- burgermenu -->
</header><!-- Header -->
<?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/company/body/header.blade.php ENDPATH**/ ?>