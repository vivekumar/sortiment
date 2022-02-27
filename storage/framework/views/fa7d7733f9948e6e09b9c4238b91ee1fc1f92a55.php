    <?php if (isset($component)) { $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015 = $component; } ?>
<?php $component = $__env->getContainer()->make(App\View\Components\GuestLayout::class, []); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
    <div id="main-wrapper">
        <div class="form-wrapper row">
            <div class="col-md-5 left-col d-flex align-items-center flex-column justify-content-between">
                <div class="top-head text-center">
                    <h1 class="main-heading">Welcome to Sortiment</h1>
                    <p>Your products are waiting for you in the shop, go login and see the products for yourself.</p>
                </div><!-- Top heading -->
                <div class="mid-col text-center">
                    <a href="<?php echo e(route('register')); ?>" class="btn bdr-btn">Create account</a>
                    <p><a href="<?php echo e(route('login')); ?>"><strong>Already have an account? </strong></a>Please login with the formular to the right</p>
                </div><!-- Middle col -->
                <div class="bot-col text-center">
                    <p>If you have any questions please contact Sortiment using <strong>support@sortiment.dk or +45 50 50 50 50</strong></p>
                </div><!-- Bottom col -->
            </div><!-- left col -->
            <div class="col-md-7 right-col d-flex align-items-center justify-content-center">
                              

                <form method="POST" action="<?php echo e(isset($guard) ? url($guard.'/login') : route('login')); ?>" class="login text-center">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.validation-errors','data' => ['class' => 'mb-4']]); ?>
<?php $component->withName('jet-validation-errors'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['class' => 'mb-4']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <?php if(session('status')): ?>
                        <div class="mb-4 font-medium text-sm text-green-600">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?> 
                    
                     <?php echo csrf_field(); ?>
                    <h2 class="main-heading">Log in</h2>
                    <div class="row">
                        <div class="col-sm-12 input-row mb-4">
                            <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/user-solid.png')); ?>" alt="" width="25"></span>
                          <input type="email" name="email" :value="old('email')"  class="form-control required" placeholder="Enter username or email address" required autofocus>
                        </div>
                        <div class="col-sm-12 input-row mb-5">
                            <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/key-solid.png')); ?>" alt="" width="25"></span>
                          <input type="password" name="password" required autocomplete="current-password" class="form-control required" placeholder="Enter password">
                        </div>
                        <div class="col-sm-12 btn-row">
                            <button type="submit" class="btn btn-blue f-width toggle-disabled" disabled>Log in</button>
                            <p><a href="<?php echo e(route('register')); ?>">Create account</a></p>
                        </div>
                    </div>
                </form><!-- Login form -->
            </div><!-- Right col -->
        </div><!-- Form wrapper -->
    </div><!-- Main wrapper -->
 <?php if (isset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015)): ?>
<?php $component = $__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015; ?>
<?php unset($__componentOriginalc3251b308c33b100480ddc8862d4f9c79f6df015); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/sortiment/resources/views/auth/login.blade.php ENDPATH**/ ?>