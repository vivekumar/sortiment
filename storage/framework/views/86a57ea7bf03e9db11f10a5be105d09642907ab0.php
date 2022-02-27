<?php $__env->startSection('content'); ?>
<form action="<?php echo e(route('companyInfoSave')); ?>" class="company-info-form" method="post"enctype="multipart/form-data" >
<div class="company-info">
    <div class="info-title">
        <h2>Your company information <span>Company name here</span></h2>
    </div><!-- Top title-->

    <?php echo csrf_field(); ?>
    <div class="row align-items-center">
        <div class="col-md-9">

            <div class="row">
                <div class="col-lg-6 input-row mb-4">
                    <label for="">Company name</label>
                    <input type="text" class="form-control" name="company" value="<?php echo e($uerDetails->company); ?>" placeholder="Company name here">
                </div>
                <div class="col-lg-6 input-row mb-4">
                    <label for="">Zip Code</label>
                    <input type="text" class="form-control" value="<?php echo e($uerDetails->zip); ?>" name="zip"  placeholder="6100">
                </div>
                <div class="col-lg-6 input-row mb-4">
                    <label for="">Contact person</label>
                    <input type="text" class="form-control required" name="name" value="<?php echo e($uerDetails->name); ?>"  placeholder="Name of contact person">
                </div>
                <div class="col-lg-6 input-row  mb-4">
                    <label for="">Address</label>
                    <input type="text" class="form-control required" name="address" value="<?php echo e($uerDetails->address); ?>"  placeholder="Hansborggade 30">
                </div>
                <div class="col-lg-6 input-row mb-4">
                    <label for="">Phone number</label>
                    <input type="text" class="form-control required" value="<?php echo e($uerDetails->phone); ?>" name="phone"  placeholder="+45 30 40 30 50">
                </div>
                <div class="col-lg-6 input-row  mb-4">
                    <label for="">Address 2</label>
                    <input type="text" class="form-control required" value="<?php echo e($uerDetails->address2); ?>" name="address2"  placeholder="2nd floor">
                </div>
                <div class="col-lg-6 input-row  mb-4">
                    <label for="">Bookingkeeper</label>
                    <input type="text" class="form-control required" placeholder="bogholderi@degnmarketing.dk" name="email" value="<?php echo e($uerDetails->email); ?>" >
                </div>
                <div class="col-lg-6 input-row  mb-4">
                    <label for="">CVR-Number</label>
                    <input type="text" class="form-control required" name="crv_no" placeholder="25252525" value="<?php echo e($uerDetails->crv_number); ?>" >
                </div>
                <div class="col-sm-12 btn-row">
                    <button type="submit" class="btn btn-blue">Save changes</button>
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <div class="profile-pic text-center">
                <a href="#">
                    <img src="<?php echo e(url($uerDetails->profile_photo_path?$uerDetails->profile_photo_path:'frontend/assets/img/profile-pic.png')); ?>" alt="Profile picture" class="user-pic">
                    <span class="camera-icon"><i class="fas fa-camera"></i></span>
                </a>
            </div>
        </div>
    </div>

</div><!-- Company Information -->
<div class="company-info">
    <div class="info-title d-flex justify-content-between align-items-center">
        <h2>Your uploads</h2>
        <small>Allowed files: JPG, PNG, AI, SVG & PDF</small>
    </div><!-- Top title-->
    <div class="form-group mb-3 upload-logo">
        <button type="button" id="btnup" class="upload-btn">
            <p id="namefile" class="">Upload a file</p>
            <img src="<?php echo e(asset('frontend/assets/img/upload-icon.png')); ?>" class="upload-icon" alt="">
        </button>
        <input type="file" value="" name="profile_photo_path" id="fileup">
    </div><!-- Upload logo-->
</div><!-- Upload -->
</form><!-- Company info form -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/company/company-information.blade.php ENDPATH**/ ?>