@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Category</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="{{ route('category.update',$category->id)}}" >
                            @csrf

                            <input type="hidden" name="id" value="{{ $category->id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>Category Name EN <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $category->category_name_en}}" name="category_name_en" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('category_name_en')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Category Name DE </h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $category->category_name_de}}" name="category_name_de" class="form-control">
                                            <div class="help-block"></div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                    <h5>Category Icon <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="cagegory_icon" class="form-control" value="{{ $category->cagegory_icon}}">
                                            @error('cagegory_icon')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Update</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        <div>
    </section>
</div>


@endsection
