@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-8">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Attribute List')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Action')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attributes as $attribute)
                            <tr>
                                <td>{{$attribute->attr_name}}</td>
                                <td><a href="{{ route('attribute.edit',$attribute->id)}}" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a>{{--<a href="{{ route('attribute.delete',$attribute->id)}}" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a>--}}<a href="{{ route('all.attributeval',$attribute->id)}}" class="waves-effect waves-light btn btn-info btn-circle mx-5"><span class="mdi mdi-arrow-right"></span></a></td>

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
                        <h3 class="box-title">{{__('Add Attribute')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="{{ route('attribute.store')}}" >
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>{{__('Attribute Name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="attr_name" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('attr_name')
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
