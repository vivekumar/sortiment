@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Edit Category')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="{{ route('category.update',$category->id)}}" >
                            @csrf

                            <input type="hidden" name="id" value="{{ $category->id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>{{__('Category Name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $category->category_name}}" name="category_name" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('category_name')
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
