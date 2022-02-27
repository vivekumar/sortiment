    
    <?php $__env->startSection('content'); ?>
    
    <div id="main-wrapper">
        <div class="form-wrapper row">
            <div class="col-md-5 left-col d-flex align-items-center flex-column justify-content-between">
                <div class="top-head text-center">
                    <h1 class="main-heading"><?php echo e(__('Welcome to Sortiment')); ?></h1>
                    <p><?php echo e(__('Your products are waiting for you in the shop, go login and see the products for yourself')); ?>.</p>
                </div><!-- Top heading -->
                <div class="mid-col text-center">
                    <a href="<?php echo e(route('register')); ?>" class="btn bdr-btn"><?php echo e(__('Create account')); ?></a>
                    <p><a href="<?php echo e(route('login')); ?>"><strong><?php echo e(__('Already have an account?')); ?> </strong></a></p>
                </div><!-- Middle col -->
                <div class="bot-col text-center">
                    <p><?php echo e(__('If you have any questions please contact Sortiment using')); ?> <strong>info@sortiment.dk  eller tlf. +45 41 88 80 80</strong></p>
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
                    <h2 class="main-heading"><?php echo e(__('Log in')); ?></h2>
                    <div class="row">
                        <div class="col-sm-12 input-row mb-4">
                            <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/user-solid.png')); ?>" alt="" width="25"></span>
                          <input type="email" name="email" :value="old('email')"  class="form-control required" placeholder="<?php echo e(__('Enter username or email address')); ?>" required autofocus>
                        </div>
                        <div class="col-sm-12 input-row mb-5">
                            <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/key-solid.png')); ?>" alt="" width="25"></span>
                          <input type="password" name="password" required autocomplete="current-password" class="form-control required" placeholder="<?php echo e(__('Enter password')); ?>">
                        </div>
                        <div class="col-sm-12 btn-row">
                            <button type="submit" class="btn btn-blue f-width toggle-disabled" disabled><?php echo e(__('Log in')); ?></button>
                            <p><a href="<?php echo e(route('register')); ?>"><?php echo e(__('Create account')); ?></a></p>
                            <p><?php if(Route::has('password.request')): ?>
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="<?php echo e(route('password.request')); ?>">
                                    <?php echo e(__('Forgot your password?')); ?>

                                </a>
                            <?php endif; ?></p>
                        </div>
                    </div>
                </form><!-- Login form -->
            </div><!-- Right col -->
        </div><!-- Form wrapper -->
    </div><!-- Main wrapper -->



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guestLogin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/auth/login.blade.php ENDPATH**/ ?>