<header class="header d-flex justify-content-between align-items-center sticky-top">
    <div class="head-left d-flex align-items-center">
        <a href="<?php echo e(url('/')); ?>" class="logo"><img src="<?php echo e(asset('frontend/assets/img/sortiment-logo.png')); ?>" alt="logo"></a>
        <div class="search">
            <a href="#" class="search-icon"><img src="<?php echo e(asset('frontend/assets/img/search-solid.png')); ?>" alt="search"></a>
            <input type="text" class="form-control" placeholder="<?php echo e(__('Search for a product')); ?>…">
        </div>
    </div><!-- Header left -->
    <div class="head-right d-flex align-items-center">
        <!--<div class="minicart">
            <a href="#" class="cart-icon">
                <span>
                    <img src="<?php echo e(asset('frontend/assets/img/shopping-cart-solid.png')); ?>" alt="">
                    <small class="cart-badge">0</small>
                </span>
                <small class="carttext">0,00 DKK In cart</small>
            </a>
        </div>--><!-- Minicart -->
        <?php
            $name=explode(' ',Auth::user()->name)
        ?>
        <div class="head-user-name">
            <a href="<?php echo e(route('emp.profile')); ?>">
                <span class="username"><?php echo e(__('Welcome')); ?> <?php echo e($name[0]); ?></span>
                <img class="user-img" src="<?php echo e(asset(Auth::user()->profile_photo_path?Auth::user()->profile_photo_path:'frontend/assets/img/user.png')); ?>" width="50px" alt="user picture">
            </a>
        </div><!-- Head user name -->
    </div><!-- Header right -->
</header><!-- Header -->
<?php /**PATH /var/www/html/laravel/sortiment/resources/views/employee/body/header.blade.php ENDPATH**/ ?>