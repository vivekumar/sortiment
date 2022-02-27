@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Edit Attribute')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="{{ route('attributeval.update',$attributevalue->id)}}" >
                            @csrf

                            <input type="hidden" name="id" value="{{ $attributevalue->id}}">
                            <input type="hidden" name="attr_id" value="{{ $attr_id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>{{__('Attribute Name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $attributevalue->attr_value}}" name="attr_value" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('attr_value')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Attribute Name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $attributevalue->attr_code}}" name="attr_code" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('attr_code')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Order')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" value="{{ $attributevalue->attr_order}}" name="attr_order" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('attr_order')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">{{__('Update')}}</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        <div>
    </section>
</div>


@endsection
