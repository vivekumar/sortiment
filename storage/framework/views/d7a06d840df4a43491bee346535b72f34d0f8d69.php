<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    <title>
        <?php if(isset($seo['metaTitle']) && !empty($seo['metaTitle'])): ?> 
            <?php echo e($seo['metaTitle']); ?>

        <?php else: ?> 
            <?php echo e(config('app.name', 'Sortiment')); ?>

        <?php endif; ?>
    </title>
    <meta name="description" content="
        <?php if(isset($seo['metaDescription']) && !empty($seo['metaDescription'])): ?> 
            <?php echo e($seo['metaDescription']); ?>        
        <?php endif; ?>
    ">
    <meta name="keywords" content="
        <?php if(isset($seo['metaTag']) && !empty($seo['metaTag'])): ?> 
            <?php echo e($seo['metaTag']); ?>        
        <?php endif; ?>
    ">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.css">
    <!-- Main CSS -->
    <?php echo $__env->yieldContent('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/snackbar.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('frontend/assets/css/responsive.css')); ?>">
    <script type="text/javascript">
        window.base_url = "<?php echo e(url('/')); ?>";
  </script>
</head>
<body>
    <div id="main-wrapper">
        <?php echo $__env->make('company.body.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="content-wrap">
            <section class="product-sec d-flex align-items-start justify-content-end">
                <?php echo $__env->make('company.body.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="products-con">
                    <?php echo $__env->yieldContent('content'); ?>
                </div><!-- Product container -->
            </section><!-- Product section -->
        </div><!-- Content wrapper -->
    </div><!-- Main wrapper -->

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="<?php echo e(asset('frontend/assets/js/custom.js')); ?>"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="<?php echo e(asset('frontend/assets/js/snackbar.js')); ?>"></script>
    
    <?php echo $__env->yieldContent('js'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/company/main_master.blade.php ENDPATH**/ ?>