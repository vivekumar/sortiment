@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-8">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Position List')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{__('Position')}}</th>
                                <th>{{__('Action')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($positions as $position)

                            <tr>
                                <td>{{$position->positions}}</td>
                                <td><a href="{{ route('position.edit',$position->id)}}" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a><a href="{{ route('position.delete',$position->id)}}" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a></td>

                            </tr>
                            @endforeach
                        </tbody>

                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                </div>

            </div>
            <div class="col-md-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Add Position')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="{{ route('position.store')}}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>{{__('Position Name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="positions" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('positions')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">{{__('Submit')}}</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        <div>
    </section>
</div>


@endsection
