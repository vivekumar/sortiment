<?php
  $prefix=Request::route()->getPrefix();
  $route=Route::current()->getName();
?>
<aside class="product-sidebar">
    <!-- burgermenu -->
    <div class="burgermenu">
        <div class="hamburger close">
            <img src="<?php echo e(asset('frontend/assets/img/burgermenu-white.png')); ?>" alt="">
        </div>
    </div><!-- burgermenu -->

    <ul class="sidebar-menu">
        <li><a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(($route == 'dashboard')? 'active':''); ?>"><i class="fas fa-shopping-cart"></i> <?php echo e(__('Order products')); ?></a></li>
        <li><a href="<?php echo e(route('myproduct')); ?>" class="<?php echo e(($route == 'myproduct')? 'active':''); ?>"><i class="fas fa-tshirt"></i> <?php echo e(__('My products')); ?></a></li>
        <li><a href="<?php echo e(route('companyInfo')); ?>" class="<?php echo e(($route == 'companyInfo')? 'active':''); ?>"><i class="bi bi-palette-fill"></i> <?php echo e(__('Your company information')); ?></a></li>
        <li><a href="<?php echo e(route('yourEmployees')); ?>" class="<?php echo e(($route == 'yourEmployees')? 'active':''); ?>"><i class="fas fa-users"></i><?php echo e(__('Your employees')); ?></a></li>
        <li><a href="<?php echo e(route('orderHostory')); ?>" class="<?php echo e(($route == 'orderHostory')? 'active':''); ?>"><i class="fas fa-receipt"></i> <?php echo e(__('Order history')); ?></a></li>
        <li><a href="<?php echo e(route('askAquestion')); ?>" class="<?php echo e(($route == 'askAquestion')? 'active':''); ?>"><i class="fas fa-question"></i> <?php echo e(__('Ask a question')); ?></a></li>
    </ul>
    <div class="sidebar-contact-info text-center">
        <ul>
            <li>
                <p>Sortiment ApS<br> Hansborggade 30, 6100 Haderslev</p>
            </li>
            <li>
                <p>Tlf: <strong>41 88 80 80</strong></p>
                <p>Kontakt: <a href="mailto:b2b@sortiment.dk"><strong>b2b@sortiment.dk</strong></a></p>
            </li>
            <li>
                <a href="https://www.facebook.com/sortiment.dk" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/sortiment.dk/?hl=da" target="_blank"><i class="fab fa-instagram"></i></a>
            </li>
        </ul>
        <ul>
            <li>
                <form method="POST" action="<?php echo e(url('logout')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php if(Auth::user()): ?>
                    <a class="block " href="<?php echo e(url('/logout')); ?>" onclick="event.preventDefault();
                                    this.closest('form').submit();"><?php echo e(__('Log Out')); ?></a>
                    <?php endif; ?>
                </form>

            </li>
        </ul>
    </div>
</aside><!-- Product sidebar -->
<?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/company/body/sidebar.blade.php ENDPATH**/ ?>