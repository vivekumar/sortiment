<?php $__env->startSection('content'); ?>
<style>
    .btn {
        font-size: 1rem;
        padding: 6px 13px;
    }

    .ask-video-sec .video {
    margin-top: 22px;
    background: #fff;
    -webkit-box-shadow: 0 0 15px #0000001a;
    -ms-box-shadow: 0 0 15px #0000001a;
    box-shadow: 0 0 15px #0000001a;
    border-radius: 20px;
}
.ask-video-sec .video iframe {
    width: 100%;
    height: 550px;
    padding: 10px;
    border-radius: 25px;
}
.ask-btn-sec a {
    width: 100%;
    margin-bottom: 12px;
}
.ask-btn-sec a {
    width: 100%;
    margin-bottom: 12px;
    text-align: left;
    padding: 12px 14px;
    font-size: 22px;
    background: #080808;
}
.ask-btn-sec a i {
    position: absolute;
    right: 15px;
    margin: 5px 0px;
}
.contact-live-chat {
    text-align: center;
    margin-top: 45px;
}
.contact-live-chat a.btn.btn-blue.modal-btn {
    background: #3020d1;
    text-align: center;
    margin-top: 5px;
}
.ask-btn-sec {
    position: relative;
}
</style>
   <!--  <div class="products-con1 ask-qus-wrap d-flex">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Sagsnummer.</th>
                    <th>Admin</th>
                    <th class="text-end"><?php echo e(__('Action')); ?></th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sn => $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($sn + 1); ?> .</td>
                    <td><?php echo e($admin->name); ?></td>
                    <td class="text-end">
                        <a href="<?php echo e(url('company/aska-question/chat', $admin->id)); ?>" class="btn btn-primary" data-toggle="tooltip" title="Ask Question">
                            Åben sag
                        </a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div> -->

    <section>
<?php
$data=\App\Models\ChatSetting::where('id',1)->first();
?>
<div class="aska-question-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-8">
                <div class="ask-video-sec">
                    <h3 class="text-center"><?php echo e(__('Watch our guide to our B2B website')); ?> </h3>
                    <div class="video">
                        <iframe src="<?php echo e($data->video); ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-4">
                <div class="ask-btn-sec">
                    <a href="<?php echo e($data->pdf4); ?>" class="btn btn-blue modal-btn" target="_blank" download><?php echo e(__('Download salg- og leveringsbetingelser')); ?> <i class="far fa-file-pdf"></i></a>

                    <a href="<?php echo e($data->pdf1); ?>" class="btn btn-blue modal-btn" target="_blank" download><?php echo e(__('Download press info')); ?> <i class="far fa-file-pdf"></i></a>
                    <a href="<?php echo e($data->pdf2); ?>" class="btn btn-blue modal-btn" target="_blank" download><?php echo e(__('Download price list')); ?> <i class="far fa-file-pdf"></i></a>
                    <a href="<?php echo e($data->pdf3); ?>" class="btn btn-blue modal-btn" target="_blank" download><?php echo e(__('Download PDF guide')); ?> <i class="far fa-file-pdf"></i></a>

                    <div class="contact-live-chat">
                        <h3><?php echo e(__('Did you not find what you were looking for?')); ?></h3>

                         <a href="<?php echo e(url('company/aska-question/chat', 1)); ?>" class="btn btn-blue modal-btn"><?php echo e(__('Contact live chat')); ?></a>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/company/ask-question.blade.php ENDPATH**/ ?>