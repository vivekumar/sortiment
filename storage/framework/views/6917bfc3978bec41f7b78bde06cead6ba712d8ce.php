<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo e(asset('backend/images/favicon.ico')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>"/>
    <title>Admin - Dashboard</title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/vendors_css.css')); ?>">
    <?php echo $__env->yieldContent('css'); ?>
	<!-- Style-->
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/style.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/skin_color.css')); ?>">
  <link rel="stylesheet" href="<?php echo e(asset('backend/css/admin.css')); ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body class="hold-transition dark-skin1 light-skin sidebar-mini theme-primary fixed">

<div class="wrapper">

  <?php echo $__env->make('admin.body.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Left side column. contains the logo and sidebar -->
 <?php echo $__env->make('admin.body.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <?php echo $__env->yieldContent('admin'); ?>
  </div>
  <!-- /.content-wrapper -->
  <?php echo $__env->make('admin.body.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->


	<!-- Vendor JS -->
	<script src="<?php echo e(asset('backend/js/vendors.min.js')); ?>"></script>
    <script src="<?php echo e(asset('./assets/icons/feather-icons/feather.min.js')); ?>"></script>
	<script src="<?php echo e(asset('./assets/vendor_components/easypiechart/dist/jquery.easypiechart.js')); ?>"></script>
	<script src="<?php echo e(asset('./assets/vendor_components/apexcharts-bundle/irregular-data-series.js')); ?>"></script>
	<!--<script src="<?php echo e(asset('./assets/vendor_components/apexcharts-bundle/dist/apexcharts.js')); ?>"></script>-->
	<script src="<?php echo e(asset('./assets/vendor_components/datatable/datatables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('backend/js/pages/data-table.js')); ?>"></script>
	<!-- Sunny Admin App -->
	<script src="<?php echo e(asset('backend/js/template.js')); ?>"></script>
	<!--<script src="<?php echo e(asset('backend/js/pages/dashboard.js')); ?>"></script>-->
    <?php echo $__env->yieldContent('js'); ?>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    $(function(){
      $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr('href');
        Swal.fire({
          title: 'Er du sikker?',
          text: "Du kan ikke fortryde handlingen!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Annuller',
          confirmButtonText: 'Bekræft'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href=link;
            Swal.fire(
              'Slettet!',
              'Din fil blev fjernet!',
              'success'
            )
          }
        });

      });
      $(document).on('click','#delete2',function(e){
        e.preventDefault();
        //var link = $(this).attr('href');
        //var link = $('#delete2').attr('action');
        Swal.fire({
          title: 'Er du sikker?',
          text: "Du kan ikke fortryde handlingen!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonText: 'Annuller',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Bekræft'
        }).then((result) => {
          if (result.isConfirmed) {
            //window.location.href=link;
            $(this).closest("form").submit();
            Swal.fire(
              'Succes!',
              'Ordrestatus ændret.',
              'success'
            )
          }
        });

      });
    });

  </script>
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
<?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/admin/admin_master.blade.php ENDPATH**/ ?>