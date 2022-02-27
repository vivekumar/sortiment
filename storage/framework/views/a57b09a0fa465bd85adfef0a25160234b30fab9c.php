<?php 
  $prefix=Request::route()->getPrefix();
  $route=Route::current()->getName();
?>
<aside class="product-sidebar">
    <ul class="sidebar-menu">        
        <li><a href="<?php echo e(route('myproduct')); ?>" class="<?php echo e(($route == 'myproduct')? 'active':''); ?>"><i class="fas fa-tshirt"></i> My products</a></li>  
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
</aside><!-- Product sidebar --><?php /**PATH /var/www/html/sortiment/resources/views/employee/body/sidebar.blade.php ENDPATH**/ ?>