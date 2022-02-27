@extends('company.main_master')
@section('content')
<div class="employee-wrap">
    <div class="row top-row d-flex align-items-center">
        <div class="col-md-6 d-flex align-items-center">
            <span class="icon"><i class="fas fa-file-excel"></i></span>
            <h3>
                Import employees using Excel
                <a href="#" class="dwn-file">Click here to download Excel template</a>
            </h3>
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <span class="icon"><i class="fas fa-plus"></i></span>
            <h3><a href="#" class="add-employee modal-btn" data-bs-toggle="modal" data-bs-target="#employeeseModal">Add employees manually</a></h3>
        </div>
    </div><!-- Top row -->
    <div class="info-title">
        <h2>Your employees <span>{{ $employees->count() }} employees found</span></h2>
    </div><!-- Top title-->
    <div class="products">
        <ul class="nav nav-tabs emp-view-icon" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a href="#" class="active" id="list-tab" data-bs-toggle="tab" data-bs-target="#listview" role="tab" aria-controls="listview" aria-selected="true"><i class="fas fa-list-ul"></i></a>
            </li>
            <li class="nav-item" role="presentation">
                <a href="#"  id="grid-tab" data-bs-toggle="tab" data-bs-target="#gridview" type="button" role="tab" aria-controls="gridview" aria-selected="false"><i class="fas fa-th-large"></i></a>
            </li>
        </ul><!-- list and grid view icon -->
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="listview" role="tabpanel" aria-labelledby="list-tab">
                <div class="table-content shadow-box list-view">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name <i class="fas fa-angle-down"></i></th>
                                    <th>Email <i class="fas fa-angle-down"></i></th>
                                    <th>Pending products <i class="fas fa-angle-down"></i></th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td>
                                            @php
                                                
                                                if ($employee->profile_photo_path && is_file(public_path($employee->profile_photo_path) )) {
                                                    $image = asset($employee->profile_photo_path);
                                                } else {
                                                    $image = asset('frontend/assets/img/employee-img.png');
                                                }
                                            @endphp
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $image }}" alt="" class="employee-pic">
                                                <h4>{{ $employee->name }} <span class="login-time">Last logged in: 21 January</span></h4>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="mailto:{{ $employee->email }}">{{ $employee->email }}</a>
                                        </td>
                                        <td>
                                            <small class="dot pending"></small>2 products pending approval
                                        </td>
                                        <td>
                                            <div class="actions">
                                                <a href="#"><i class="fas fa-eye"></i></a>
                                                <a href="#"><i class="fas fa-ellipsis-v"></i></a>
                                                <a href="#"><i class="fas fa-trash-alt"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- table details -->
                </div><!-- List view -->
            </div><!-- Tab panel-->
            <div class="tab-pane fade" id="gridview" role="tabpanel" aria-labelledby="grid-tab">
                <div class="product-grid-view">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="grid-col shadow-box">

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="employeeseModal" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
        <div class="modal-header text-center">
        <h5 class="modal-title">Add employees manually</h5>
        <p>We will automatically generate a user and password for each employee</p>
        <button type="button" class="btn-close round-btn" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="modal-body">
            <form class="add-emp-form" id="form-employee">

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name & last name</th>
                            <th>Email</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody id="employee-container">
                        <tr>
                            <td><input type="text" class="form-control employee-name" name="employee[0][name]" placeholder="Employee name" value=""></td>
                            <td><input type="text" class="form-control employee-email" name="employee[0][email]" placeholder="Employee email" value=""></td>
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
        </div><!-- modal body-->
    </div>
    </div>
</div><!-- Price modal-->
<script type="text/javascript">
    saveEmployee = () => {
        if (!validateEmployeeForm()) {
            snackbar.warning("Warning: Email should be unique!");
            return;
        }

        $('#form-employee').prepend('<input type="hidden" name="_token" value="{{ csrf_token() }}" />');

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
                    snackbar.success('Employees were saved!');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            }
        });
    }
</script>
@endsection
