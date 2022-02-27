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
                  <form method="get" class="pull-right" id="comform">
                      <select name="company" class="select2 pull-left ml-20" onchange='submitForm();'>
                      <option value="" selected="" disabled="">Select company</option>
                          <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($user->id); ?>" <?php if(isset($_GET['company']) && $_GET['company']==$user->id): ?> selected <?php endif; ?>><?php echo e($user->company); ?> (<?php echo e($user->name); ?>)</option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </form>
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
								<th>Name </th>
                                <th>Company </th>
								<th>Action</th>

							</tr>
						</thead>
						<tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <img src="<?php echo e(asset($item->product->product_thambnail)); ?>" style="width: 60px; height: 50px;">  </td>
                                <td><?php echo e($item->product->product_name); ?></td>
                                <td><?php echo e($item->product->product_price); ?></td>
                                <td><?php echo e(\App\Models\User::where('id',$item->user_id)->value('name')); ?></td>
                                <td><?php echo e(\App\Models\User::where('id',$item->user_id)->value('company')); ?></td>
                                <td>
                                    <a href="<?php echo e(route('companyp.edit',$item->id)); ?>" class="btn btn-info" title="Edit Data"><i class="fa fa-eye"></i> </a>
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
<?php $__env->startSection('js'); ?>

<script src="<?php echo e(asset('./assets/vendor_components/select2/dist/js/select2.full.js')); ?>"></script>
 <script>
 $(function () {
    "use strict";
    //Initialize Select2 Elements
    $('.select2').select2();
 });

 function submitForm(){
    document.getElementById('comform').submit();
 }
 </script>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/sortiment/resources/views/backend/price_request/list.blade.php ENDPATH**/ ?>