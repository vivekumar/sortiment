<?php $__env->startSection('content'); ?>

<div class="company-info">
    <form action="<?php echo e(route('companyInfoSave')); ?>" class="company-info-form" method="post"enctype="multipart/form-data" >
    <div class="info-title nameImg">
        <h2><?php echo e(__('Your company information')); ?> <span><?php echo e($uerDetails->company); ?></span></h2>
        <div class="profile-pic text-center">
            <a href="#">
                <img id="img1" src="<?php echo e(url($uerDetails->profile_photo_path?$uerDetails->profile_photo_path:'frontend/assets/img/user.png')); ?>" alt="Profile picture" class="user-pic">
                <span class="camera-icon upload-image"><input type='file' class="imgInp" data-id='img1' name="profile_photo_path" id="fileup1" /><i class="fas fa-camera"></i></span>
            </a>
        </div>
    </div><!-- Top title-->

    <?php echo csrf_field(); ?>
    <div class="row align-items-center">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-4 input-row mb-4">
                    <label for=""><?php echo e(__('Company name')); ?></label>
                    <input type="text" class="form-control" name="company" value="<?php echo e($uerDetails->company); ?>" placeholder="Navn på virksomhed">
                    <?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-lg-4 input-row mb-4">
                    <label for=""><?php echo e(__('Contact person')); ?></label>
                    <input type="text" class="form-control required" name="name" value="<?php echo e($uerDetails->name); ?>"  placeholder="Dit navn">
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-lg-4 input-row mb-4">
                    <label for=""><?php echo e(__('Zip code')); ?></label>
                    <input type="text" class="form-control" value="<?php echo e($uerDetails->zip); ?>" name="zip"  placeholder="Postnummer">
                    <?php $__errorArgs = ['zip'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="col-lg-4 input-row  mb-4">
                    <label for=""><?php echo e(__('Address')); ?></label>
                    <input type="text" class="form-control required" name="address" value="<?php echo e($uerDetails->address); ?>"  placeholder="Adresse">
                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-lg-4 input-row mb-4">
                    <label for=""><?php echo e(__('Phone number')); ?></label>
                    <input type="text" class="form-control required" value="<?php echo e($uerDetails->phone); ?>" name="phone"  placeholder="Telefon nummer">
                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-lg-4 input-row  mb-4">
                    <label for=""><?php echo e(__('Address')); ?> 2</label>
                    <input type="text" class="form-control required" value="<?php echo e($uerDetails->address2); ?>" name="address2"  placeholder="Adresse">

                </div>
                <div class="col-lg-4 input-row  mb-4">
                    <label for=""><?php echo e(__('Bookingkeeper')); ?></label>
                    <input type="text" class="form-control required" placeholder="Bogholder email" name="email" value="<?php echo e($uerDetails->email); ?>" >
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-lg-4 input-row  mb-4">
                    <label for=""><?php echo e(__('CVR number')); ?></label>
                    <input type="text" class="form-control required" name="crv_no" placeholder="Indtast cvr nummer" value="<?php echo e($uerDetails->crv_number); ?>" maxlength="8">
                    <?php $__errorArgs = ['crv_no'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-lg-4 input-row  mb-4">
                    <label for=""><?php echo e(__('EAN number')); ?></label>
                    <input type="text" class="form-control required" name="ean_number" placeholder="Indtast ean nummer" value="<?php echo e($uerDetails->ean_number); ?>" maxlength="13">
                    <?php $__errorArgs = ['ean_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="text-danger"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-sm-12 btn-row">
                    <button type="submit" class="btn btn-blue"><?php echo e(__('Save changes')); ?></button>
                </div>
            </div>

        </div>
        
    </div>
    </form><!-- Company info form -->
</div><!-- Company Information -->

<div class="company-info">
    <div class="info-title d-flex justify-content-between align-items-center">
        <h2><?php echo e(__('Your uploads')); ?></h2>
        <small><?php echo e(__('Allowed files')); ?>: JPG, PNG, AI, SVG & PDF</small>
    </div><!-- Top title-->

    <div class="row">
        <div class="col-md-3">
          <form action="<?php echo e(route('companyImgUploads')); ?>" class="company-info-form" method="post"enctype="multipart/form-data" >
          <?php echo csrf_field(); ?>
            <div class="form-group mb-3 upload-logo">
                <button type="button" id="btnup" class="upload-btn">
                    <p id="namefile" class=""><?php echo e(__('Upload a file')); ?></p>
                    <img src="<?php echo e(asset('frontend/assets/img/upload-icon.png')); ?>" class="upload-icon" alt="">
                </button>
                <input type="file" value="" name="images" id="fileup">
                <input type="hidden" value="<?php echo e(Auth::user()->id); ?>" name="id" >

            </div><!-- Upload logo-->
            <?php $__errorArgs = ['images'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
               <p style="display:block"> <span class="text-danger"><?php echo e($message); ?></span></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <div class="col-sm-12 btn-row">
                    <button type="submit" class="btn btn-blue">Upload</button>
                </div>
          </form>
        </div>

        <div class="col-md-9">

            <div class="profile-pic pro-dd">
                <?php $__currentLoopData = $allimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="div-pro-dd">
                    <a href="<?php echo e(url('company/images/delete/'.$allimage->id)); ?>"><span class="delete-icon"><i class="fas fa-trash-alt"></i></span></a>
                    <img src="<?php echo e(asset($allimage->image)); ?>" alt="Profile picture" class="user-pic">
                    <a href="<?php echo e(asset($allimage->image)); ?>" download><span class="download-icon"><i class="fas fa-download"></i></span></a>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </div>

        <!--
        </div> -->
    </div>
</div><!-- Upload -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/company/company-information.blade.php ENDPATH**/ ?>