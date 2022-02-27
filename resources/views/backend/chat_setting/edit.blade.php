@extends('admin.admin_master')
@section('admin')
<div class="container-full">

    <section class="content">
		<div class="row">

            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{__('Guides og materiale')}}</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="post" action="{{ route('update.chat.setting')}}" >
                            @csrf

                            <input type="hidden" name="id" value="1">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h5>{{__('Video Link')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $data->video}}" name="video" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('video')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Csr politik PDF')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $data->pdf1}}" name="pdf1" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('pdf1')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Prisliste på tryk')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $data->pdf2}}" name="pdf2" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('pdf2')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Transfer guide ')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $data->pdf3}}" name="pdf3" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('pdf3')
                                            <span class="text-tenger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>{{__('Download salg- og leveringsbetingelser')}} <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" value="{{ $data->pdf4}}" name="pdf4" class="form-control" required="" data-validation-required-message="This field is required" aria-invalid="false">
                                            @error('pdf4')
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
