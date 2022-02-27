<?php $__env->startSection('content'); ?>
<div class="employee-wrap">
    <div class="row top-row d-flex align-items-center">
        <div class="col-md-6 d-flex align-items-center">
        <a href="javascript:void(0);" class="modal-btn" data-bs-toggle="modal" data-bs-target="#excelModal" style="width: 80px;margin-right: 20px;"><span class="icon"><i class="fas fa-file-excel"></i></span></a>
            <h3>
            <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#excelModal" class="modal-btn"><?php echo e(__('Import employees using Excel')); ?></a>
                <a href="<?php echo e(url('/')); ?>/public/uploads/excel/Oprettelses skabelon.xlsx" class="dwn-file" download><?php echo e(__('Click here to download Excel template')); ?></a>
            </h3>
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <span class="icon"><i class="fas fa-plus"></i></span>
            <h3><a href="#" class="add-employee modal-btn" data-bs-toggle="modal" data-bs-target="#employeeseModal"><?php echo e(__('Add employees manually')); ?></a></h3>
        </div>
    </div>
    <div class="info-title">
        <h2><?php echo e(__('Your employees')); ?> <span><?php echo e($employees->count()); ?> <?php echo e(__('employees found')); ?></span></h2>
    </div>
    <div class="products">
        <ul class="nav nav-tabs emp-view-icon" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#" class="active" id="list-tab" data-bs-toggle="tab" data-bs-target="#listview" role="tab" aria-controls="listview" aria-selected="true"><i class="fas fa-list-ul"></i></a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#"  id="grid-tab" data-bs-toggle="tab" data-bs-target="#gridview" type="button" role="tab" aria-controls="gridview" aria-selected="false"><i class="fas fa-th-large"></i></a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="listview" role="tabpanel" aria-labelledby="list-tab">
            <div class="table-content shadow-box list-view">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th><?php echo e(__('Name')); ?> <i class="fas fa-angle-down"></i></th>
                                <th><?php echo e(__('Email')); ?> <i class="fas fa-angle-down"></i></th>
                                <th><?php echo e(__('Pending products')); ?> <i class="fas fa-angle-down"></i></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php
                                            // set a default image
                                            if ($employee->profile_photo_path && is_file(public_path() . '/' . $employee->profile_photo_path)) {
                                                $image = asset($employee->profile_photo_path);
                                            } else {
                                                $image = asset('frontend/assets/img/user.png');
                                            }
                                        ?>
                                        <div class="d-flex align-items-center">
                                            <img src="<?php echo e($image); ?>" alt="" class="employee-pic" height="70" width="70" style="border-radius: 50%">
                                            <h4><?php echo e($employee->name); ?> <span class="login-time"><?php echo e(__("Last logged in")); ?>: <?php if(!empty($employee->last_login_at)): ?> <?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $employee->last_login_at)->format('d. F')); ?> <?php endif; ?></span></h4>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="mailto:<?php echo e($employee->email); ?>"><?php echo e($employee->email); ?></a>
                                    </td>
                                    <td>
                                        <small class="dot pending"></small><?php echo e(\App\Models\OrderEmployee::where('employee_id',$employee->id)->where('status','pending')->count()); ?> <?php echo e(__('products pending approval')); ?>

                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a href="<?php echo e(url('/company/view-employee/' . $employee->id)); ?>"><i class="fas fa-eye"></i></a>
                                            <a href="<?php echo e(url('/company/edit-employee/' . $employee->id)); ?>"><i class="fas fa-edit"></i></a>
                                            <a onclick="return confirm('Are you sure?') ? true : false" href="<?php echo e(url('/company/delete-employee/' . $employee->id)); ?>"><i class="fas fa-trash-alt"></i></a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="gridview" role="tabpanel" aria-labelledby="grid-tab">
            <div class="product-grid-view">
                <div class="row">
                    <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="grid-col shadow-box">
                                <div class="p-25">
                                    <div class="emp-short-info d-flex align-items-center">
                                        <figure class="emp-pic">
                                            <?php
                                            // set a default image
                                            if ($employee->profile_photo_path && is_file(public_path() . '/' . $employee->profile_photo_path)) {
                                                    $image = asset($employee->profile_photo_path);
                                                } else {
                                                    $image = asset('frontend/assets/img/user.png');
                                                }
                                            ?>
                                            <img src="<?php echo e(asset($image)); ?>" alt="<?php echo e($employee->name); ?>" height="70" width="70" style="border-radius: 50%">
                                        </figure>
                                        <div class="emp-name">
                                            <h4><a href="#"><?php echo e($employee->name); ?></a></h4>
                                            <span class="login-time"><?php echo e(__('Last logged in')); ?>: <?php if(!empty($employee->last_login_at)): ?> <?php echo e(\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $employee->last_login_at)->format('d. F')); ?> <?php endif; ?></span>
                                        </div>
                                    </div>
                                    <h5 class="text-center"><?php echo e(__('Approved products')); ?>: <?php echo e(\App\Models\OrderEmployee::where('employee_id',$employee->id)->where('status','approved')->count()); ?></h5>
                                    <span class="btn green-btn"><?php echo e(__('Products needing approval')); ?>: <?php echo e(\App\Models\OrderEmployee::where('employee_id',$employee->id)->where('status','pending')->count()); ?></span>
                                </div>
                                <div class="orderbtn-row">
                                    <a href="<?php echo e(url('/company/view-employee/' . $employee->id)); ?>" class="btn btn-blue"><?php echo e(__('See orders')); ?></a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="modal fade" id="excelModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header justify-content-center text-center">
        <h5 class="modal-title" id="excelModalLabel"><strong>
        <?php echo e(__('Import employees using Excel')); ?></strong></h5>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form action="" class="price-form">
                <div id="errors"></div>
                <div class="company-info">
                    <div class="form-group mb-3 upload-logo">
                        <button type="button" id="btnup" class="upload-btn">
                            <p id="namefile" class=""><?php echo e(__('Upload her')); ?></p>
                            <img src="<?php echo e(asset('frontend/assets/img/upload-icon.png')); ?>" class="upload-icon" alt="">
                        </button>
                        <input type="file" value="" name="fileup" id="fileup">
                    </div><!-- row-->
                    <div id="responseMsg" ></div>
                    <div class='alert alert-danger mt-2 d-none text-danger' id="err_file"></div>
                    <div class="form-group">
                        <button type="button" id="submit" class="btn btn-blue f-width"><?php echo e(__('Upload Excel file')); ?></button>
                    </div>
                </div>
            </form><!-- Price form-->
        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="employeeseModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header text-center">
        <h5 class="modal-title"><?php echo e(__('Add employees manually')); ?></h5>
        <p><?php echo e(__('We will automatically generate a user and password for each employee')); ?></p>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form class="add-emp-form" id="form-employee">
                <?php echo csrf_field(); ?>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th><?php echo e(__('Name & last name')); ?></th>
                            <th><?php echo e(__('Email')); ?></th>
                            <th class="text-right"><?php echo e(__('Action')); ?></th>
                        </tr>
                    </thead>
                    <tbody id="employee-container">
                        <tr>
                            <td><input type="text" class="form-control employee-name" name="employee[0][name]" placeholder="<?php echo e(__('Employee name')); ?>" value=""></td>
                            <td><input type="text" class="form-control employee-email" name="employee[0][email]" placeholder="<?php echo e(__('Employee email')); ?>" value=""></td>
                            <td>
                                <button class="btn btn-danger" type="button" onclick="confirm('Are you sure?') ? $(this).parent().parent().remove() : false">
                                    <i class="fa fa-minus-circle"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-end">
                                <button class="btn btn-lg btn-primary" id="add-employe-button" data-toggle="tooltip" title="Add Another" type="button">
                                    <i class="fa fa-plus-circle"></i>
                                </button>
                            </td>
                            <td>
                                <button type="button" class="btn btn-lg btn-success" data-toggle="tooltip" title="Save" onclick="saveEmployee()">
                                    <i class="fa fa-save"></i>
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
<script type="text/javascript">
    saveEmployee = () => {
        if (!validateEmployeeForm()) {
            snackbar.warning("Warning: Email should be unique!");
            return;
        }

        //$('#form-employee').prepend('<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />');

        $.ajax({
            url: base_url + '/company/create-employee',
            type: 'post',
            dataType: 'json',
            data: $('#form-employee').serialize(),
            success: (json) => {
                if (json.errors) {
                    for (let e in json.errors) {
                        if (json.errors[e]['name']) {
                            $('input[name="employe[' + e + '][name]"]').after('<divv class="text-danger">' + json.errors[e]['name'] + '</div>');
                        }

                        if (json.errors[e]['email']) {
                            $('input[name="employe[' + e + '][email]"]').after('<divv class="text-danger">' + json.errors[e]['email'] + '</div>');
                        }
                    }
                }

                if (json.success) {
                    snackbar.success('Medarbejdere blev oprettet.');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            }
        });
    }
    (() => {
        setTimeout(() => {
            <?php if(Session::has('message')): ?>
                snackbar.success("<?php echo e(Session::get('message')); ?>");
            <?php endif; ?>
        }, 500);
    })();

</script>
<script>
  var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

  $(document).ready(function(){

    $('#submit').click(function(){
        console.log('ewrwe');
      // Get the selected file
      var files = $('#fileup')[0].files;

      if(files.length > 0){
         var fd = new FormData();

         // Append data
         fd.append('file',files[0]);
         fd.append('_token',CSRF_TOKEN);

         // Hide alert
         $('#responseMsg').hide();

         // AJAX request
         $.ajax({
           url: "<?php echo e(route('uploadFile')); ?>",
           method: 'post',
           data: fd,
           contentType: false,
           processData: false,
           dataType: 'json',
           success: function(response){
            $("#errors").html('');
             // Hide error container
             $('#err_file').removeClass('d-block');
             $('#err_file').addClass('d-none');

             if(response.success == 1){ // Uploaded successfully

               // Response message
               $('#responseMsg').removeClass("alert alert-danger");
               $('#responseMsg').addClass("alert alert-success");
               $('#responseMsg').html(response.message);
               $('#responseMsg').show();

               // File preview
               $('#filepreview').show();
               $('#filepreview img,#filepreview a').hide();

                setTimeout(() => {
                    location.reload();
                }, 1000);

             }else if(response.success == 2){ // File not uploaded

               // Response message
               $('#responseMsg').removeClass("alert alert-success");
               $('#responseMsg').addClass("alert alert-danger");
               $('#responseMsg').html(response.message);
               $('#responseMsg').show();
             }else{
               // Display Error
               $('#err_file').text(response.error);
               $('#err_file').removeClass('d-none');
               $('#err_file').addClass('d-block');
             }
           },
           error: function(xhr, status, error)
            {
                $('#err_file').text('');
                $('#err_file').removeClass('d-block');
                $('#err_file').addClass('d-none');
                $.each(xhr.responseJSON.errors, function (key, item)
                {
                    $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                });
            },
           /*error: function(response){
              console.log("error : " + JSON.stringify(response) );
           }*/
         });
      }else{
         alert("Please select a file.");
      }

    });
  });
  </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('company.main_master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/laravel/sortiment/resources/views/company/your-employee.blade.php ENDPATH**/ ?>