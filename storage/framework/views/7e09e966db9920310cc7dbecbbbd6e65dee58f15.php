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
				  <h3 class="box-title"><?php echo e(__('Alle forspørgsler')); ?></h3>
                  <a href="<?php echo e(route('companyp.add')); ?>" class="btn btn-info pull-right ml-10"><i class="fa fa-add fa-1x" ></i> <?php echo e(__('Opret forspørgsel')); ?></a>
                  <form method="get" class="pull-right" id="comform">
                      <select name="company" class="select2 pull-left ml-20" onchange='submitForm();'>
                      <option value="" selected="" disabled="">Vælg virksomhed</option>
                          <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($user->id); ?>" <?php if(isset($_GET['company']) && $_GET['company']==$user->id): ?> selected <?php endif; ?>><?php echo e($user->company); ?> (<?php echo e($user->name); ?>)</option>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </select>
                  </form>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="table-responsive">
					  <table id="example11" class="table table-bordered table-striped">
						<thead>
							<tr>
								
								<th><?php echo e(__('Name')); ?> </th>
                                <th><?php echo e(__('Company')); ?> </th>
                                <th><?php echo e(__('Logo on product')); ?> </th>
                                <th><?php echo e(__('Text on product')); ?> </th>
								<th><?php echo e(__('Action')); ?></th>

							</tr>
						</thead>
						<tbody>
                            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                
                                <td><?php echo e(\App\Models\User::where('id',$item->user_id)->value('name')); ?></td>
                                <td><?php echo e(\App\Models\User::where('id',$item->user_id)->value('company')); ?></td>
                                <td> <?php if($item->logo_on_product==1): ?><?php echo e(__('Yes')); ?> <?php else: ?> <?php echo e(__('No')); ?><?php endif; ?></td>
                                <td> <?php if($item->text_on_product==1): ?><?php echo e(__('Yes')); ?> <?php else: ?> <?php echo e(__('No')); ?><?php endif; ?></td>

                                <td>
                                    <a href="<?php echo e(route('companyp.view',$item->id)); ?>" class="btn btn-info" title="Edit Data"><i class="fa fa-eye"></i> </a>
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
 $('#example11').dataTable({
        "order": []
    });
 function submitForm(){
    document.getElementById('comform').submit();
 }
 </script>
 <?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/backend/price_request/list.blade.php ENDPATH**/ ?>