<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sortiment B2B - Order Product</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/style.css')); ?>">
</head>
<body>
    <div id="main-wrapper">
        <?php echo $__env->make('employee.body.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="content-wrap">
            <section class="product-sec d-flex align-items-start justify-content-end">
                <?php echo $__env->make('employee.body.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="products-con">
                    <?php echo $__env->yieldContent('content'); ?>
                </div><!-- Product container -->
            </section><!-- Product section -->
        </div><!-- Content wrapper -->
    </div><!-- Main wrapper -->

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <script src="<?php echo e(asset('frontend/assets/js/custom.js')); ?>"></script>
    <?php echo $__env->yieldContent('js'); ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script>
  <?php if(Session::has('message')): ?>
    var type="<?php echo e(Session::get('alert-type','info')); ?>"
    switch(type){
      case 'info':
      toastr.info(" <?php echo e(Session::get('message')); ?> ");
      break;

      case 'success':
      toastr.success(" <?php echo e(Session::get('message')); ?> ");
      break;

      case 'warning':
      toastr.warning(" <?php echo e(Session::get('message')); ?> ");
      break;

      case 'error':
      toastr.error(" <?php echo e(Session::get('message')); ?> ");
      break;
    }
  <?php endif; ?>
  </script>
</body>
</html>
<?php /**PATH /var/www/html/laravel/sortiment/resources/views/employee/main_master.blade.php ENDPATH**/ ?>