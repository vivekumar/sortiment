<?php $__env->startSection('admin'); ?>
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-12">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo e(__('Kunder')); ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Email')); ?></th>
                                <th><?php echo e(__('Company')); ?></th>
                                <th><?php echo e(__('CRV Number')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td> <?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->company); ?></td>
                                <td><?php echo e($user->crv_number); ?></td>
                                <td><!--<a href="" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a><a href="" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a><button onclick="getdetail(this,<?php echo e($user->id); ?>)" href="" class="btn btn-primary" title="Product Details Data"><i class="fa fa-eye"></i> </button>-->
                                <a href="<?php echo e(route('user.view',$user->id)); ?>" class="btn btn-primary" title="Product Details Data"><i class="fa fa-eye"></i> </a>
                                <?php if($user->approved_at): ?>
                                    <a href="<?php echo e(route('admin.users.unapprove',$user->id)); ?>" class="btn btn-success" title="Active"><i class="fa fa-thumbs-up"></i> </a>
                                <?php else: ?>
                                    <a href="<?php echo e(route('admin.users.approve',$user->id)); ?>" class="btn btn-danger" title="Inactive"><i class="fa fa-thumbs-down"></i> </a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('user.delete',$user->id)); ?>" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i> </a>
                                </td>

                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                </div>

            </div>


  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">User Details</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>

      </div>
    </div>
  </div>



        <div>
    </section>
</div>


<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script>
function getdetail(that,id){
    //$('#myModal').modal('show');
    $.ajax({
        url: "<?php echo e(url('/company/user/getdetail/ajax')); ?>/"+id,
        type:"GET",
        dataType:"json",
        success:function(data) {
            //console.log(data);
            var html="";
            html+='<div class="row">';
            html+='<div class="col-md-4 offset-md-4">';
            if (data.profile_photo_path == null || data.profile_photo_path==''){
                html+='<div><img src="<?php echo e(url("/")); ?>/public/uploads/no_image.jpg" style="height:100px;width:auto"></div>';
            }else{
                html+='<div><img src="<?php echo e(url("/")); ?>/public/'+data.profile_photo_path+'" style="height:100px;width:auto"></div>';

            }
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Name</label><input class="form-control " type="text" value="'+data.name+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Email</label><input class="form-control " type="text" value="'+data.email+'" readonly>';
            html+='</div>';

            html+='<div class="col-md-6">';
            html+='<label>Phone</label><input class="form-control " type="text" value="'+data.phone+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Company</label><input class="form-control " type="text" value="'+data.company+'" readonly>';
            html+='</div>';

            html+='<div class="col-md-6">';
            html+='<label>Zip Code</label><input class="form-control " type="text" value="'+data.zip+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>CVR-Number</label><input class="form-control " type="text" value="'+data.crv_number+'" readonly>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Address</label><textarea class="form-control" readonly>'+data.address+'</textarea>';
            html+='</div>';
            html+='<div class="col-md-6">';
            html+='<label>Address2</label><textarea class="form-control" readonly>'+data.address2+'</textarea>';
            html+='</div>';

            html+='</div>';


            $('.modal-body').html(html)
            $('#myModal').modal('show');
        },
    });

}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/backend/user/view.blade.php ENDPATH**/ ?>