@extends('company.main_master')
@section('content')

<div class="company-info">
    <form action="{{ route('companyInfoSave')}}" class="company-info-form" method="post"enctype="multipart/form-data" >
    <div class="info-title nameImg">
        <h2>{{__('Your company information')}} <span>{{$uerDetails->company}}</span></h2>
        <div class="profile-pic text-center">
            <a href="#">
                <img id="img1" src="{{url($uerDetails->profile_photo_path?$uerDetails->profile_photo_path:'frontend/assets/img/user.png') }}" alt="Profile picture" class="user-pic">
                <span class="camera-icon upload-image"><input type='file' class="imgInp" data-id='img1' name="profile_photo_path" id="fileup1" /><i class="fas fa-camera"></i></span>
            </a>
        </div>
    </div><!-- Top title-->

    @csrf
    <div class="row align-items-center">
        <div class="col-md-12">

            <div class="row">
                <div class="col-lg-4 input-row mb-4">
                    <label for="">{{__('Company name')}}</label>
                    <input type="text" class="form-control" name="company" value="{{$uerDetails->company}}" placeholder="Navn på virksomhed">
                    @error('company')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 input-row mb-4">
                    <label for="">{{__('Contact person')}}</label>
                    <input type="text" class="form-control required" name="name" value="{{$uerDetails->name}}"  placeholder="Dit navn">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 input-row mb-4">
                    <label for="">{{__('Zip code')}}</label>
                    <input type="text" class="form-control" value="{{$uerDetails->zip}}" name="zip"  placeholder="Postnummer">
                    @error('zip')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-lg-4 input-row  mb-4">
                    <label for="">{{__('Address')}}</label>
                    <input type="text" class="form-control required" name="address" value="{{$uerDetails->address}}"  placeholder="Adresse">
                    @error('address')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 input-row mb-4">
                    <label for="">{{__('Phone number')}}</label>
                    <input type="text" class="form-control required" value="{{$uerDetails->phone}}" name="phone"  placeholder="Telefon nummer">
                    @error('phone')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 input-row  mb-4">
                    <label for="">{{__('Address')}} 2</label>
                    <input type="text" class="form-control required" value="{{$uerDetails->address2}}" name="address2"  placeholder="Adresse">

                </div>
                <div class="col-lg-4 input-row  mb-4">
                    <label for="">{{__('Bookingkeeper')}}</label>
                    <input type="text" class="form-control required" placeholder="Bogholder email" name="email" value="{{$uerDetails->email}}" >
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 input-row  mb-4">
                    <label for="">{{__('CVR number')}}</label>
                    <input type="text" class="form-control required" name="crv_no" placeholder="Indtast cvr nummer" value="{{$uerDetails->crv_number}}" maxlength="8">
                    @error('crv_no')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-lg-4 input-row  mb-4">
                    <label for="">{{__('EAN number')}}</label>
                    <input type="text" class="form-control required" name="ean_number" placeholder="Indtast ean nummer" value="{{$uerDetails->ean_number}}" maxlength="13">
                    @error('ean_number')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-12 btn-row">
                    <button type="submit" class="btn btn-blue">{{__('Save changes')}}</button>
                </div>
            </div>

        </div>
        
    </div>
    </form><!-- Company info form -->
</div><!-- Company Information -->

<div class="company-info">
    <div class="info-title d-flex justify-content-between align-items-center">
        <h2>{{__('Your uploads')}}</h2>
        <small>{{__('Allowed files')}}: JPG, PNG, AI, SVG & PDF</small>
    </div><!-- Top title-->

    <div class="row">
        <div class="col-md-3">
          <form action="{{ route('companyImgUploads')}}" class="company-info-form" method="post"enctype="multipart/form-data" >
          @csrf
            <div class="form-group mb-3 upload-logo">
                <button type="button" id="btnup" class="upload-btn">
                    <p id="namefile" class="">{{__('Upload a file')}}</p>
                    <img src="{{asset('frontend/assets/img/upload-icon.png') }}" class="upload-icon" alt="">
                </button>
                <input type="file" value="" name="images" id="fileup">
                <input type="hidden" value="{{Auth::user()->id}}" name="id" >

            </div><!-- Upload logo-->
            @error('images')
               <p style="display:block"> <span class="text-danger">{{ $message }}</span></p>
                @enderror
            <div class="col-sm-12 btn-row">
                    <button type="submit" class="btn btn-blue">Upload</button>
                </div>
          </form>
        </div>

        <div class="col-md-9">

            <div class="profile-pic pro-dd">
                @foreach($allimages as $allimage)
                <div class="div-pro-dd">
                    <a href="{{url('company/images/delete/'.$allimage->id)}}"><span class="delete-icon"><i class="fas fa-trash-alt"></i></span></a>
                    <img src="{{asset($allimage->image) }}" alt="Profile picture" class="user-pic">
                    <a href="{{asset($allimage->image) }}" download><span class="download-icon"><i class="fas fa-download"></i></span></a>
                </div>
                @endforeach

            </div>

        </div>

        <!--
        </div> -->
    </div>
</div><!-- Upload -->

@endsection
