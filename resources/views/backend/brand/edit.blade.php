@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Edit Brand')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="{{ route('brand.update',$brand->id)}}" >
                            @csrf

                            <input type="hidden" name="id" value="{{ $brand->id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>{{__('Navn på brand')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $brand->brand_name}}" name="brand_name" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('brand_name')
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
