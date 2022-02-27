@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-8">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Attribute List')}} </h3>
                    <a href="{{ route('all.attribute',$attr_id)}}" class="waves-effect waves-light btn btn-info btn-circle mx-5 pull-right float-right"><span class="mdi mdi-arrow-left"></span></a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{__('Value')}}</th>
                                <th>{{__('Code')}}</th>
                                <th>{{__('Order')}}</th>
                                <th>{{__('Action')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attributevalues as $attribute)
                            <tr>
                                <td>{{$attribute->attr_value}}</td>
                                <td>{{$attribute->attr_code}}</td>
                                <td>{{$attribute->attr_order}}</td>
                                <td><a href="{{ route('attributeval.edit',['id'=>$attribute->id,'attr_id'=>$attr_id])}}" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a><a href="{{ route('attributeval.delete',$attribute->id)}}" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a></td>

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

                        <form method="post" action="{{ route('attributeval.store', ['attr_id' => $attr_id])}}" >
                            @csrf
                            <input type="hidden" name="attr_id" value="{{$attr_id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>{{__('Attribute Value')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="attr_value" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('attr_value')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Attribute Code')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="attr_code" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('attr_code')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Order')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" value="" name="attr_order" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('attr_order')
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
