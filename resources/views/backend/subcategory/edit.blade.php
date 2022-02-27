@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Edit Sub Category')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="{{ route('subcategory.update',$subcategory->id)}}" >
                            @csrf

                            <input type="hidden" name="id" value="{{ $subcategory->id}}">
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>{{__('Category Name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control select2" required data-validation-required-message="{{__('This field is required')}}">
                                                <option value="">------{{__('Select Category')}}----------</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id}}" @if($category->id ==$subcategory->category_id) {{'selected'}} @endif>{{ $category->category_name}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>{{__('SubCategory Name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $subcategory->subcategory_name}}" name="subcategory_name" class="form-control" required="" data-validation-required-message="{{__('This field is required')}}" aria-invalid="false">

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
