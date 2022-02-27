<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('emp.profile.update')); ?>" class="company-info-form" method="post"enctype="multipart/form-data" >
<div class="company-info">
    <div class="info-title">
        <h2><?php echo e(__('Your company information')); ?> <span><?php echo e(\App\Models\User::where('id',Auth::user()->user_id)->value('company')); ?></span></h2>
    </div><!-- Top title-->

    <?php echo csrf_field(); ?>
    <div class="row align-items-center">
        <div class="col-md-9">

            <div class="row">
                <div class="col-lg-6 input-row mb-4">
                    <label for=""><?php echo e(__('Name')); ?></label>
                    <input type="text" class="form-control" name="name" value="<?php echo e(Auth::user()->name); ?>" placeholder="Name here">
                </div>

                <div class="col-lg-6 input-row  mb-4">
                    <label for=""><?php echo e(__('Email')); ?></label>
                    <input type="text" class="form-control required" placeholder="bogholderi@degnmarketing.dk" name="email" value="<?php echo e(Auth::user()->email); ?>" >
                </div>
                <div class="col-lg-6 input-row mb-4">
                    <label for=""><?php echo e(__('Phone number')); ?></label>
                    <input type="text" class="form-control required" value="<?php echo e(Auth::user()->phone); ?>" name="phone"  placeholder="+45 30 40 30 50">
                </div>
                <div class="col-lg-6 input-row  mb-4">
                    <label for=""><?php echo e(__('Address')); ?></label>
                    <input type="text" class="form-control required" name="address" value="<?php echo e(Auth::user()->address); ?>"  placeholder="Hansborggade 30">
                </div>

                <div class="col-sm-12 btn-row">
                    <button type="submit" class="btn btn-blue">Save changes</button>
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <div class="profile-pic text-center">
                <a href="#">
                    <img id="img1" src="<?php echo e(url(Auth::user()->profile_photo_path?Auth::user()->profile_photo_path:'frontend/assets/img/user.png')); ?>" alt="Profile picture" class="user-pic">
                    <span class="camera-icon upload-image"><input type='file' class="imgInp" name="profile_photo_path" data-id='img1' /><i class="fas fa-camera"></i></span>
                </a>
            </div>
        </div>

    </div>
</div><!-- Company Information -->


</form><!-- Company info form -->
<hr/>
<form action="<?php echo e(route('emp.profile.updatepass')); ?>" class="company-info-form" method="post"enctype="multipart/form-data" class="login" >
    <?php echo csrf_field(); ?>
    <div class="row align-items-center">
        <div class="col-md-9">

            <div class="row">
                <div class="col-sm-12 input-row mb-4">
                    <label for="password">Indtast ny adgangskode</label>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'password','class' => 'form-control','type' => 'password','name' => 'password','required' => true,'autocomplete' => 'new-password','placeholder' => 'Indtast ny adgangskode','readonly' => true,'onfocus' => 'this.removeAttribute(\'readonly\');']]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'password','class' => 'form-control','type' => 'password','name' => 'password','required' => true,'autocomplete' => 'new-password','placeholder' => 'Indtast ny adgangskode','readonly' => true,'onfocus' => 'this.removeAttribute(\'readonly\');']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-tenger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-sm-12 input-row mb-4">
                    <label for="password_confirmation"><?php echo e(__('Confirm Password')); ?></label>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'jetstream::components.input','data' => ['id' => 'password_confirmation','class' => 'form-control','type' => 'password','name' => 'password_confirmation','required' => true,'autocomplete' => 'new-password','placeholder' => ''.e(__('Confirm Password')).'','readonly' => true,'onfocus' => 'this.removeAttribute(\'readonly\');']]); ?>
<?php $component->withName('jet-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes(['id' => 'password_confirmation','class' => 'form-control','type' => 'password','name' => 'password_confirmation','required' => true,'autocomplete' => 'new-password','placeholder' => ''.e(__('Confirm Password')).'','readonly' => true,'onfocus' => 'this.removeAttribute(\'readonly\');']); ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
                    <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-tenger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-sm-12 btn-row">
                    <button type="submit" class="btn btn-blue">Bekræft</button>
                </div>
            </div>

        </div>


    </div>

</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('employee.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/employee/employee-information.blade.php ENDPATH**/ ?>