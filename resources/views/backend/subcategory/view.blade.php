@extends('admin.admin_master')
@section('css')
    <link href="{{ asset('assets/vendor_components/fontawsome/css/vendor/fontawsome5.css') }}" rel="stylesheet" />

@endsection
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Add Sub Category')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">

                        <form method="post" class="form subcategory" action="{{ route('subcategory.store')}}" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>{{__('Category Name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select name="category_id" class="form-control select2" required data-validation-required-message="{{__('This field is required')}}">
                                                <option value="">------{{__('Select Category')}}----------</option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id}}">{{ $category->category_name}}</option>
                                                @endforeach
                                            </select>
                                            @error('subcategory_name_fr')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5>{{__('SubCategory Name')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text"  name="subcategory_name" class="form-control" required="" data-validation-required-message="{{__('This field is required')}}" aria-invalid="false">
                                            @error('subcategory_name')
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
            <div class="col-12">

                <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{__('Sub Category List')}}</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>{{__('SubCategory Name')}}</th>
                                <th>{{__('Category')}}</th>
                                <th>{{__('Action')}}</th>

                            </tr>
                        </thead>

                        <tbody>
                            @foreach($subcategory as $cate)
                            @php //print_r($cate['category']) @endphp
                            <tr>
                                <td>{{$cate->subcategory_name}}</td>
                                <td>{{$cate['category']['category_name']}}</td>
                                <td><a href="{{ route('subcategory.edit',$cate->id)}}" class="btn btn-circle btn-info btn-sm mb-5" title="Edit"><i class="fa fa-edit" aria-hidden="true" style="font-size:1rem"></i></a><a href="{{ route('subcategory.delete',$cate->id)}}" class="btn btn-circle btn-danger btn-sm mb-5" id="delete" title="Delete"><i class="fa fa-trash" style="font-size:1rem"></i></a></td>

                            </tr>
                            @endforeach
                        </tbody>

                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
                </div>

            </div>

        <div>
    </section>
</div>


@endsection
@section('js')
<script src="{{ asset('./assets/icons/feather-icons/feather.min.js')}}"></script>
<script src="{{ asset('backend/js/pages/validation.js')}}"></script>
<script src="{{ asset('backend/js/pages/form-validation.js')}}"></script>
<script>

    $(document).ready(function(){

        $("input[type='radio']").click(function(){
            console.log('fsdf');
            var radioValue = $("input[name='group1']:checked").val();
            if(radioValue==1){
                $('form.subcategory').removeClass('hide');
                $('form.subcategory').addClass('show');
                $('form.type').removeClass('show');
                $('form.type').addClass('hide');
            }else{
                $('form.subcategory').removeClass('show');
                $('form.subcategory').addClass('hide');
                $('form.type').removeClass('hide');
                $('form.type').addClass('show');
            }
        });
    });
</script>
@endsection
