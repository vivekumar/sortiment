<?php 
  $prefix=Request::route()->getPrefix();
  $route=Route::current()->getName();
?>
<aside class="product-sidebar">
    <ul class="sidebar-menu">
        <li><a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(($route == 'dashboard')? 'active':''); ?>"><i class="fas fa-shopping-cart"></i> Order products</a></li>
        <li><a href="<?php echo e(route('myproduct')); ?>" class="<?php echo e(($route == 'myproduct')? 'active':''); ?>"><i class="fas fa-tshirt"></i> My products</a></li>
        <li><a href="<?php echo e(route('companyInfo')); ?>" class="<?php echo e(($route == 'companyInfo')? 'active':''); ?>"><i class="bi bi-palette-fill"></i> Your company information</a></li>
        <li><a href="<?php echo e(route('yourEmployees')); ?>" class="<?php echo e(($route == 'yourEmployees')? 'active':''); ?>"><i class="fas fa-users"></i>Your employees</a></li>
        <li><a href="<?php echo e(route('orderHostory')); ?>" class="<?php echo e(($route == 'orderHostory')? 'active':''); ?>"><i class="fas fa-receipt"></i> Order history</a></li>
        <li><a href="<?php echo e(route('askAquestion')); ?>" class="<?php echo e(($route == 'askAquestion')? 'active':''); ?>"><i class="fas fa-question"></i> Ask a question</a></li>
    </ul>
    <div class="sidebar-contact-info text-center">
        <ul>
            <li>
                <p>Sortiment ApS<br> Hansborggade 30, 6100 Haderslev</p>
            </li>
            <li>
                <p>Tlf: <strong>30 30 30 30</strong></p>
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
                                    this.closest('form').submit();">Log Out</a>                    
                    <?php endif; ?>
                </form>
                
            </li>
        </ul>
    </div>
</aside><!-- Product sidebar --><?php /**PATH /var/www/html/sortiment/resources/views/company/body/sidebar.blade.php ENDPATH**/ ?>