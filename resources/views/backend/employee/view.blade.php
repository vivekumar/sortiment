@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-12">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Employee List')}}</h3>
                    <form method="get" class="pull-right" id="comform">
                      <select name="company" class="select2 pull-left ml-20" onchange='submitForm();'>
                      <option value="" selected="" disabled="">{{__('Select company')}}</option>
                          @foreach($users as $user)
                          <option value="{{$user->id}}" @if(isset($_GET['company']) && $_GET['company']==$user->id) selected @endif>{{$user->company}} ({{$user->name}})</option>
                          @endforeach
                      </select>
                  </form>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Email')}}</th>
                                <th>{{__('Company')}}</th>
                                <!--<th>Action</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td> {{ $employee->name}}</td>
                                <td>{{$employee->email}}</td>
                                <td>{{$employee->company}}</td>
                                <!--<td><a href="{{-- route('user.edit',$user->id)--}}" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a><a href="{{-- route('user.delete',$user->id)--}}" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a></td>-->

                            </tr>
                            @endforeach
                        </tbody>

                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                </div>

            </div>
            <!--<div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Category</h3>
                    </div>
                    <div class="box-body">
                        <form method="post" action="{{-- route('category.store')--}}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="category_name_en" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('category_name_en')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Email </h5>
                                        <div class="controls">
                                            <input type="text"  name="category_name_de" class="form-control">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <h5>Category Icon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="cagegory_icon" class="form-control">
                                            @error('cagegory_icon')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>-->
        <div>
    </section>
</div>


@endsection

@section('js')
<script>
function submitForm(){
        $("form").submit();
    }
</script>
@endsection
