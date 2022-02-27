@extends('admin.admin_master')
@section('css')
    <!--<link href="{{ asset('backend/assets/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/vendors/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}" rel="stylesheet" />-->
@endsection

@section('admin')


	  <div class="container-full">
		<!-- Content Header (Page header) -->


		<!-- Main content -->
		<section class="content">

		 <!-- Basic Forms -->
		  <div class="box">
			<div class="box-header with-border">
			  <h4 class="box-title">{{__('Price request')}} </h4>

			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <div class="row">
				<div class="col">
                <form action="{{route('companyp.store')}}" id="upload_form" method="post" class="price-form" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row1 mb-3 ">
                        <div class="row form-group">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>{{__('Company')}} <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="user_id" id="user_id" class="form-control select2"  >
                                            <option value="" selected="" disabled="">{{__('Select Company')}}</option>
                                            @foreach($users as $user)
                                            <option value="{{ $user->id }}" >{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('user_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <h5>{{__('Products')}} </h5>
                                    <div class="controls">
                                        <select name="product_id" class="form-control select2"  >
                                            <option value="" selected="" disabled="">{{__('Select Company')}}</option>
                                            @foreach($products as $product)
                                            <option value="{{ $product->id }}" @if($user->id==old('product_id')) selected @endif>{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('product_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div><!-- Form group -->
                        <div class="row form-group">
                            <label for="" class="col-md-6 col-sm-12 col-form-label">{{__('Do you want your logo on the product')}}?</label>
                            <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end1">
                                <div class="controls">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="noRadio" name="logo_on_product" value="0">
                                        <label for="noRadio">{{__('No')}}</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="yesRadio" name="logo_on_product" value="1">
                                        <label for="yesRadio">{{__('Yes')}}</label>
                                    </div>
                                </div>

                            </div><!-- filed group -->
                        </div><!-- Form group -->
                        <div class="row form-group logoOnP hide">
                            <label for="" class="col-md-6 col-sm-12 col-form-label">{{__('Where do you want your logo position')}}?</label>
                            <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end">
                                <div class="form-check d-flex flex-wrap">
                                    <div class="d-flex align-items-center col-md-6">
                                        <input class="form-check-input" type="checkbox" id="check1" name="logo_front_left" value="Front left">
                                        <label class="form-check-label" for="check1">
                                            Front left
                                        </label>
                                    </div><!-- div -->
                                    <div class="d-flex align-items-center col-md-6">
                                        <input class="form-check-input" type="checkbox" id="check2" name="logo_front_right" value="Front right">
                                        <label class="form-check-label" for="check2">
                                            Front right
                                        </label>
                                    </div><!-- div -->
                                    <div class="d-flex align-items-center col-md-6">
                                        <input class="form-check-input" type="checkbox" id="check3" name="logo_shoulder_left" value="Shoulder left">
                                        <label class="form-check-label" for="check3">
                                            Shoulder left
                                        </label>
                                    </div><!-- div -->
                                    <div class="d-flex align-items-center col-md-6">
                                        <input class="form-check-input" type="checkbox" id="check4" name="logo_shoulder_right" value="Shoulder right">
                                        <label class="form-check-label" for="check4">
                                            Shoulder right
                                        </label>
                                    </div><!-- div -->
                                    <div class="d-flex align-items-center col-md-6">
                                        <input class="form-check-input" type="checkbox" id="check5" name="logo_onthe_back_side" value="On the backside">
                                        <label class="form-check-label" for="check5">
                                            On the backside
                                        </label>
                                    </div><!-- div -->
                                </div>
                            </div><!-- filed group -->
                        </div><!-- Form group -->
                    </div><!-- form row -->
                    <div class="form-row1 mb-3 ">
                        <div class="row form-group">
                            <label for="" class="col-md-6 col-sm-12 col-form-label">{{__('Do you want to assign a text to the product')}}?</label>
                            <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end1">
                                <div class="controls">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="noRadio2" name="text_on_product" value="0">
                                        <label for="noRadio2">No</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="yesRadio2" name="text_on_product" value="1">
                                        <label for="yesRadio2">Yes</label>
                                    </div>
                                </div>

                            </div><!-- filed group -->
                        </div><!-- Form group -->
                        <div class="row form-group textOnP hide" >
                            <label for="" class="col-md-6 col-sm-12 col-form-label">{{__('Where do you want your text position')}}?</label>
                            <div class="col-md-6 col-sm-12 filed-group d-flex justify-content-end1">
                                <div class="form-check d-flex flex-wrap">
                                    <div class="d-flex align-items-center col-md-6">
                                        <input class="form-check-input" type="checkbox" id="check01" name="text_front_left" value="Front left">
                                        <label class="form-check-label" for="check01">
                                            Front left
                                        </label>
                                    </div><!-- div -->
                                    <div class="d-flex align-items-center col-md-6">
                                        <input class="form-check-input" type="checkbox" id="check02" name="text_front_right" value="Front right">
                                        <label class="form-check-label" for="check02">
                                            Front right
                                        </label>
                                    </div><!-- div -->
                                    <div class="d-flex align-items-center col-md-6">
                                        <input class="form-check-input" type="checkbox" id="check03" name="text_shoulder_left" value="Shoulder left">
                                        <label class="form-check-label" for="check03">
                                            Shoulder left
                                        </label>
                                    </div><!-- div -->
                                    <div class="d-flex align-items-center col-md-6">
                                        <input class="form-check-input" type="checkbox" id="check04" name="text_shoulder_right" value="Shoulder right">
                                        <label class="form-check-label" for="check04">
                                            Shoulder right
                                        </label>
                                    </div><!-- div -->
                                    <div class="d-flex align-items-center col-md-6">
                                        <input class="form-check-input" type="checkbox" id="check05" name="text_onthe_back_side" value="On the backside">
                                        <label class="form-check-label" for="check05">
                                            On the backside
                                        </label>
                                    </div><!-- div -->
                                </div>
                            </div><!-- filed group -->
                        </div><!-- Form group -->
                    </div><!-- form row -->
                    <div class="form-group1 mb-3 upload-logo">
                        <div class="sec_logo">
                            <div class="upload_logo">
                                <button type="button" id="btnup" class="upload-btn d-flex align-items-center">
                                <img src="{{asset('frontend/assets/img/upload-icon.png') }}" class="upload-icon" alt="">
                                <p id="namefile" class="">
                                    <strong>{{__('Upload your logo')}} <small class="d-flex">{{__('Allowed files')}}: eps</small></strong>
                                </p>
                                </button>
                                <input type="file" value="" name="logo" id="fileup">
                            </div>
                            <div class="sec-logo-flex">

                            </div>
                        </div>
                    </div><!-- Upload logo-->
                    <div class="form-group mb-3">
                        <textarea name="message" id="message" cols="" rows="" class="form-control" placeholder="Leave a note, with further information about your acquirements."></textarea>
                    </div><!-- row-->
                    <div class="form-group">
                        <button type="submit" id="RequestPrice" class="btn btn-blue f-width">{{__('Request price')}}</button>
                    </div><!-- row-->

                    <div id="errors"></div>
                </form><!-- Price form-->

				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-body -->
		  </div>
		  <!-- /.box -->

		</section>
		<!-- /.content -->
	  </div>



@endsection
@section('js')

<script>
    $(".price-form input[name='logo_on_product']").click(function() {
        var logoc=$(".price-form input[name='logo_on_product']:checked").val();
        if(1==logoc) {
            $(".logoOnP").show(300);
            $(".logoOnP").removeClass('hide');
            $(".logoOnP").addClass('show');
        } else {
            $(".logoOnP").hide(200);
        }
    });
    $(".price-form input[name='text_on_product']").click(function() {
        var logot=$(".price-form input[name='text_on_product']:checked").val();
        if(logot==1) {
            $(".textOnP").show(300);
            $(".textOnP").removeClass('hide');
            $(".textOnP").addClass('show');
        } else {
            $(".textOnP").hide(200);
        }
    });

</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

      /*$(document).ready(function() {
        $('#upload_form').on('submit', function(event){
            $("#errors").html("")
            event.preventDefault();
            var logot=$(".price-form input[name='Radios2']:checked").val();
            var logoc=$(".price-form input[name='Radios']:checked").val();
            var check1=$("#check1").val();
            var check2=$("#check2").val();
            var check3=$("#check3").val();
            var check4=$("#check4").val();
            var check5=$("#check5").val();
            var check01=$("#check01").val();
            var check02=$("#check02").val();
            var check03=$("#check03").val();
            var check04=$("#check04").val();
            var check05=$("#check05").val();
            var message=$('#message').val();

            $.ajax({
                url:"{{ route('priceRequest') }}",
                method:"POST",
                data:new FormData(this),
                //dataType:"json",
                processData: false,
                contentType: false,
                success:function(data) {
                    console.log(data.data);
                    console.log(data);
                    $('.modal-body').html('');
                    $('.modal-title').html('');

                    $('.modal-body').html(data.data.message);
                },
                error: function(xhr, status, error)
                {
                    $.each(xhr.responseJSON.errors, function (key, item)
                    {
                        $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                    });
                }
            });

        });
    });*/
    $('#user_id').on('change', function(event){
        var user_id=$(this).val();
        $.ajax({
                url:"{{ url('price-request/ajax/get_images') }}/"+user_id,
                method:"GET",
                data:'',
                //dataType:"json",
                processData: false,
                contentType: false,
                success:function(data) {
                    console.log(data);
                    $('.sec-logo-flex').html('');
                    $('.sec-logo-flex').html(data);
                }
            });

    });

</script>
@endsection

