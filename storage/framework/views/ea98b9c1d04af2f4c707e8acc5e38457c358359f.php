    <?php $__env->startSection('content'); ?>
    

    <div id="main-wrapper">
        <div class="form-wrapper row">
            <div class="col-md-5 left-col d-flex align-items-center flex-column justify-content-between">
                <div class="top-head text-center">
                    <h1 class="main-heading"><?php echo e(__('Welcome to Sortiment')); ?></h1>
                    <p><?php echo e(__('Your products are waiting for you in the shop, go login and see the products for yourself')); ?>.</p>
                </div><!-- Top heading -->
                <div class="mid-col text-center">
                    <a href="<?php echo e(route('login')); ?>" class="btn bdr-btn"><?php echo e(__('Log in')); ?></a>
                    <p><a href="<?php echo e(route('login')); ?>"><strong><?php echo e(__('Already have an account?')); ?> </strong></a></p>
                </div><!-- Middle col -->
                <div class="bot-col text-center">
                    <p><?php echo e(__('If you have any questions please contact Sortiment using')); ?> <strong>info@sortiment.dk  eller tlf. +45 41 88 80 80</strong></p>
                </div><!-- Bottom col -->
            </div><!-- left col -->
            <div class="col-md-7 right-col d-flex align-items-center justify-content-center">
              <form method="POST" action="<?php echo e(route('register')); ?>" class="login text-center">
                <?php echo csrf_field(); ?>
                <h2 class="main-heading"><?php echo e(__('Create an account')); ?></h2>
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
                <div class="row">
                  <div class="col-lg-6 input-row mb-4">
                      <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/user-solid.png')); ?>" alt="" width="25"></span>
                    <input type="text" class="form-control required" placeholder="<?php echo e(__('Name and lastname')); ?>" name="name" :value="old('name')" required autofocus autocomplete="name" >
                  </div>
                  <div class="col-lg-6 input-row mb-4">
                      <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/envelope-solid.png')); ?>" alt="" width="25"></span>
                    <input type="email" name="email" :value="old('email')" required class="form-control required" placeholder="<?php echo e(__('Email')); ?>">
                  </div>
                  <div class="col-lg-6 input-row mb-4">
                      <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/building-solid.png')); ?>" alt="" width="25"></span>
                    <input type="text" name="company" class="form-control required" placeholder="<?php echo e(__('Company name')); ?>">
                  </div>
                  <div class="col-lg-6 input-row  mb-4">
                      <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/building-solid.png')); ?>" alt="" width="25"></span>
                    <input type="text" name="crv_number" class="form-control required" placeholder="<?php echo e(__('CVR number')); ?>" maxlength="8">
                  </div>
                  <div class="col-lg-6 input-row  mb-4">
                      <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/map-marker-alt-solid.png')); ?>" alt="" width="25"></span>
                    <input type="text" name="address" class="form-control required" placeholder="<?php echo e(__('Address')); ?>">
                  </div>
                  <div class="col-lg-6 input-row  mb-4">
                      <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/map-marker-alt-solid.png')); ?>" alt="" width="25"></span>
                    <input type="text" name="city" class="form-control required" placeholder="<?php echo e(__('City')); ?>">
                  </div>
                  <div class="col-lg-6 input-row mb-5">
                      <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/key-solid.png')); ?>" alt="" width="25"></span>
                    <input type="password" name="password" required autocomplete="new-password" class="form-control required" placeholder="<?php echo e(__('Password')); ?>">
                  </div>
                  <div class="col-lg-6 input-row mb-5">
                    <!--<?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.label','data' => ['for' => 'password_confirmation','value' => ''.e(__('Confirm Password')).'']]); ?>
<?php $component->withName('jet-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['for' => 'password_confirmation','value' => ''.e(__('Confirm Password')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>-->
                    <span class="input-icon"><img src="<?php echo e(asset('frontend/assets/img/key-solid.png')); ?>" alt="" width="25"></span>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'password_confirmation','class' => 'block mt-1 w-full form-control','type' => 'password','name' => 'password_confirmation','required' => true,'autocomplete' => 'new-password','placeholder' => ''.e(__('Confirm Password')).'']]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'password_confirmation','class' => 'block mt-1 w-full form-control','type' => 'password','name' => 'password_confirmation','required' => true,'autocomplete' => 'new-password','placeholder' => ''.e(__('Confirm Password')).'']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                  </div>
                  <div class="col-sm-12 btn-row">
                      <button type="submit" class="btn btn-blue f-width toggle-disabled" disabled><?php echo e(__('Create account')); ?></button>
                      <p><a href="<?php echo e(route('login')); ?>"><?php echo e(__('Login here')); ?></a></p>
                  </div>
                </div>
              </form><!-- Login form -->
          </div><!-- Right col -->
        </div><!-- Form wrapper -->
    </div><!-- Main wrapper -->

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guestReg', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/auth/register.blade.php ENDPATH**/ ?>