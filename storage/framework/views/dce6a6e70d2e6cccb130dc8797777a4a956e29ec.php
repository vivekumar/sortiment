<?php
  $prefix=Request::route()->getPrefix();
  $route=Route::current()->getName();
?>
<aside class="product-sidebar">
    <ul class="sidebar-menu">
        <li><a href="<?php echo e(route('emp.shop')); ?>" class="<?php echo e(($route == 'emp.shop')? 'active':''); ?>"><i class="fas fa-tshirt"></i> <?php echo e(__('My products')); ?></a></li>
        <li><a href="<?php echo e(route('emp.profile')); ?>" class="<?php echo e(($route == 'emp.profile')? 'active':''); ?>"><i class="fas fa-tshirt"></i> <?php echo e(__('My profile')); ?></a></li>
        <li><a href="<?php echo e(route('emp.askAquestion')); ?>" class="<?php echo e(($route == 'emp.askAquestion')? 'active':''); ?>"><i class="fas fa-question"></i> <?php echo e(__('Ask a question')); ?></a></li>
    </ul>
    <div class="sidebar-contact-info text-center">
        <ul>
            <li>
                <p>Sortiment ApS<br> Hansborggade 30, 6100 Haderslev</p>
            </li>
            <li>
                <p>Tlf: <strong>41 88 80 80</strong></p>
                <p>Kontakt: <a href="mailto:info@sortiment.dk"><strong>info@sortiment.dk</strong></a></p>
            </li>
            <li>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
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
<?php /**PATH /var/www/html/laravel/sortiment/resources/views/employee/body/sidebar.blade.php ENDPATH**/ ?>