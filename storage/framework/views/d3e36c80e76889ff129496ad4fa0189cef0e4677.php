<?php $__env->startSection('admin'); ?>


  <!-- Content Wrapper. Contains page content -->

	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">
		  <div class="row">



			<div class="col-12">

			 <div class="box">
				<div class="box-header with-border">
				  <h3 class="box-title">Product List</h3>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Image </th>
								<th>Product Name</th>
								<th>Price </th>
								<th>SKU </th>
								<!--<th>Discount </th>-->
								<th>Status </th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody>
	 <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	 <tr>
		<td> <img src="<?php echo e(asset($item->product_thambnail)); ?>" style="width: 60px; height: 50px;">  </td>
		<td><?php echo e($item->product_name); ?></td>
		 <td><?php echo e($item->product_price); ?></td>
		 <td><?php echo e($item->product_sku); ?></td>
		 

		 <td>
		 	<?php if($item->status == 1): ?>
		 	<span class="badge badge-pill badge-success"> Active </span>
		 	<?php else: ?>
           <span class="badge badge-pill badge-danger"> InActive </span>
		 	<?php endif; ?>

		 </td>

		<td width="30%">
 			<a href="<?php echo e(route('product.edit',$item->id)); ?>" class="btn btn-primary" title="Product Details Data"><i class="fa fa-eye"></i> </a>
			<a href="<?php echo e(route('product.edit',$item->id)); ?>" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i> </a>
			<a href="<?php echo e(route('product.delete',$item->id)); ?>" class="btn btn-danger" title="Delete Data" id="delete">
 				<i class="fa fa-trash"></i></a>
			<?php if($item->status == 1): ?>
				<a href="<?php echo e(route('product.inactive',$item->id)); ?>" class="btn btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
			<?php else: ?>
				<a href="<?php echo e(route('product.active',$item->id)); ?>" class="btn btn-success" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
			<?php endif; ?>
		</td>

	 </tr>
	  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>

					  </table>
					</div>
				</div>
				<!-- /.box-body -->
			  </div>
			  <!-- /.box -->


			</div>
			<!-- /.col -->





		  </div>
		  <!-- /.row -->
		</section>
		<!-- /.content -->

	  </div>




<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/backend/product/list.blade.php ENDPATH**/ ?>