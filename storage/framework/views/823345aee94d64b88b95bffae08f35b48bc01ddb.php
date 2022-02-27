<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo e(asset('backend/images/favicon.ico')); ?>">

    <title>Sortiment Admin - Log in </title>

	<!-- Vendors Style-->
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/vendors_css.css')); ?>">

	<!-- Style-->
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/style.css')); ?>">
	<link rel="stylesheet" href="<?php echo e(asset('backend/css/skin_color.css')); ?>">

</head>
<body class="hold-transition theme-primary bg-gradient-primary">

	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">

			<div class="col-12">
				<div class="row justify-content-center no-gutters">
					<div class="col-lg-4 col-md-5 col-12">
						<div class="content-top-agile p-10">
							<h2 class="text-white">administrator login</h2>
							
						</div>
						<div class="p-30 rounded30 box-shadowed b-2 b-dashed">
                        <form method="POST" action="<?php echo e(isset($guard) ? url($guard.'/login') : route('login')); ?>">
                            <?php echo csrf_field(); ?>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
										</div>
										<input  id="email" type="email" name="email" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Email ">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text  bg-transparent text-white"><i class="ti-lock"></i></span>
										</div>
										<input  id="password" type="password" name="password" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Adgangskode">
									</div>
								</div>
								  <div class="row">
                                  
									<!-- /.col -->
									<div class="col-12 text-center">
									  <button type="submit" class="btn btn-info btn-rounded mt-10">Log ind</button>
									</div>
									<!-- /.col -->
								  </div>
							</form>

							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Vendor JS -->
	<script src="<?php echo e(asset('backend/js/vendors.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend./assets/icons/feather-icons/feather.min.js')); ?>"></script>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\laravel\sortiment\resources\views/auth/admin_login.blade.php ENDPATH**/ ?>