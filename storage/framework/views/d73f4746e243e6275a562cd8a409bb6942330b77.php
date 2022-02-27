<?php $__env->startSection('admin'); ?>
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo e(__('Company info')); ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3">
                            <?php if(!empty($user->profile_photo_path)): ?>
                                <img src="<?php echo e(asset($user->profile_photo_path)); ?>" style="height:100px;width:auto" class="img-responsive">

                                <p><a href="<?php echo e(asset($user->profile_photo_path)); ?>" class="btn btn-file btn-info" download><?php echo e(__('Click here to download')); ?> </a></p>

                            <?php else: ?>
                                <img src="<?php echo e(asset('public/uploads/no_image.jpg')); ?>"  class="img-responsive">
                            <?php endif; ?>

                            </div>
                            <div class="col-md-9">

                                <div class="row">
                                    <div class="col-md-6">
                                        <p><?php echo e(__('Contact person')); ?> : <?php echo e($user->name); ?></p>
                                        <p><?php echo e(__('Bookingkeeper')); ?> : <?php echo e($user->email); ?></p>
                                        <p><?php echo e(__('Company name')); ?> : <?php echo e($user->company); ?></p>
                                        <p><?php echo e(__('Phone number')); ?> : <?php echo e($user->phone); ?></p>

                                    </div>
                                    <div class="col-md-6">
                                        <p><?php echo e(__('CVR-Number')); ?> : <?php echo e($user->crv_number); ?></p>
                                        <p><?php echo e(__('Address')); ?> : <?php echo e($user->address); ?></p>
                                        <p><?php echo e(__('Address')); ?> 2 : <?php echo e($user->address2); ?></p>
                                        <p><?php echo e(__('Zip Code')); ?> : <?php echo e($user->zip); ?></p>
                                    </div>

                                </div>

                            </div>

                            <div class="col-md-12">
                            <hr>
                            </div>
                            <div class="col-md-12">

                                <div class="row">
                                    <?php
                                        $allimages = DB::table('company_uploads')->where('user_id',$user->id)->get();
                                    ?>
                                    <?php $__currentLoopData = $allimages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allimage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-md-2">
                                        <a href="<?php echo e(asset($allimage->image)); ?>" download>
                                            <img src="<?php echo e(asset($allimage->image)); ?>" class="img-responsive" style="max-width: 100%;"/>
                                        </a>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo e(__('View Employee')); ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <div class="table-responsive">
                            <table id="example" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Email')); ?></th>
                                    <th><?php echo e(__('Order')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td> <?php echo e($employee->name); ?></td>
                                    <td><?php echo e($employee->email); ?></td>
                                    <td><?php echo e(\App\Models\OrderEmployee::where('employee_id',$employee->id)->count()); ?></td>
                                    <td><button onclick="getdetail(this,<?php echo e($user->id); ?>)" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-eye" aria-hidden="true" style="font-size:1rem"></i></button></td>

                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        <div>
    </section>
</div>


<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"><?php echo e(__('User Orders')); ?></h4>
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

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script src="https://cdn.jsdelivr.net/momentjs/2.14.1/moment-with-locales.min.js"></script>
<script>
function getdetail(that,id){
    //$('#myModal').modal('show');
    var base_url="<?php echo e(url('/')); ?>";
    $.ajax({
        url: "<?php echo e(url('/company/employee/orderdetail/ajax')); ?>/"+id,
        type:"GET",
        dataType:"json",
        success:function(data) {
            //console.log(data);
            var html="";
            html+='<table id="example1" class="table">';

            html+='<tr>';
            html+='<th>Image</th><th>Product</th><th>Order no</th><th>Status</th><th>Date</th><th>Action</th>';
            html+='</tr>';
            $.each(data, function( key, cdata1 ) {
                var date = new Date(cdata1.created_at);
                var newDate = date.toString('dd-MM-yy');

                var date11 = moment(new Date(newDate.substr(0, 16)));
                if(cdata1.status=='approved'){
                    var badge='success';
                    var faicon='on';
                }else{
                    var badge='danger';
                    var faicon='off';
                }

            html+='<tr class="col-md-6">';
            html+='<td><img src="'+base_url+'/'+cdata1.product_thambnail+'" width="100"></td>';
            html+='<td>'+cdata1.product_name+'</td>';
            html+='<td>'+cdata1.order_number+'</td>';
            html+='<td><span class="badge badge-pill badge-'+badge+'"> '+cdata1.status+' </span></td>';
            html+='<td>'+date11.format("DD-MMM-YYYY")+'</td>';
            html+='<td><button onclick="emporderstatus(this,'+cdata1.id+')" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-toggle-'+faicon+'" aria-hidden="true" style="font-size:2rem; margin-top:5px"></i></button></td>';
            html+='</tr>';

            });


            html+='</table>';


            $('.modal-body').html(html)
            $('#myModal').modal('show');
        },
    });

}
function emporderstatus(thhat,id){
    var status=$(thhat).parent().parent().find('td:eq(3) span').text();
    var base_url="<?php echo e(url('/')); ?>";
    $.ajax({
        url: "<?php echo e(url('/company/employee/orderstatus-change/ajax')); ?>/"+id+'/'+status,
        type:"GET",
        dataType:"json",
        success:function(data) {
            if(data=="pending"){
                $(thhat).parent().parent().find('td:eq(3) span').text(data);
                $(thhat).parent().parent().find('td:eq(3) span').removeClass('badge-success');
                $(thhat).parent().parent().find('td:eq(3) span').addClass('badge-danger');

                $(thhat).find('i').removeClass('fa-toggle-on');
                $(thhat).find('i').addClass('fa-toggle-off');
            }else{
                $(thhat).parent().parent().find('td:eq(3) span').text(data);
                $(thhat).parent().parent().find('td:eq(3) span').removeClass('badge-danger');
                $(thhat).parent().parent().find('td:eq(3) span').addClass('badge-success');

                $(thhat).find('i').removeClass('fa-toggle-off');
                $(thhat).find('i').addClass('fa-toggle-on');
            }
            console.log(data);
        }
    });
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.admin_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/backend/user/show.blade.php ENDPATH**/ ?>