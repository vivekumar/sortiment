@extends('employee.main_master')
@section('content')
<form action="{{ route('emp.profile.update')}}" class="company-info-form" method="post"enctype="multipart/form-data" >
<div class="company-info">
    <div class="info-title">
        <h2>{{__('Your company information')}} <span>{{\App\Models\User::where('id',Auth::user()->user_id)->value('company');}}</span></h2>
    </div><!-- Top title-->

    @csrf
    <div class="row align-items-center">
        <div class="col-md-9">

            <div class="row">
                <div class="col-lg-6 input-row mb-4">
                    <label for="">{{__('Name')}}</label>
                    <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}" placeholder="Indtast dit navn">
                </div>

                <div class="col-lg-6 input-row  mb-4">
                    <label for="">{{__('Email')}}</label>
                    <input type="text" class="form-control required" placeholder="Indtast din email" name="email" value="{{Auth::user()->email}}" >
                </div>
                <div class="col-lg-6 input-row mb-4">
                    <label for="">{{__('Phone number')}}</label>
                    <input type="text" class="form-control required" value="{{Auth::user()->phone}}" name="phone"  placeholder=" Indtast tlf nr.">
                </div>
                <div class="col-lg-6 input-row  mb-4">
                    <label for="">{{__('Address')}}</label>
                    <input type="text" class="form-control required" name="address" value="{{Auth::user()->address}}"  placeholder="Indtast din adresse">
                </div>

                <div class="col-sm-12 btn-row">
                    <button type="submit" class="btn btn-blue">Gem</button>
                </div>
            </div>

        </div>
        <div class="col-md-3">
            <div class="profile-pic text-center">
                <a href="#">
                    <img id="img1" src="{{url(Auth::user()->profile_photo_path?Auth::user()->profile_photo_path:'frontend/assets/img/user.png') }}" alt="Profile picture" class="user-pic">
                    <span class="camera-icon upload-image"><input type='file' class="imgInp" name="profile_photo_path" data-id='img1' /><i class="fas fa-camera"></i></span>
                </a>
            </div>
        </div>

    </div>
</div><!-- Company Information -->


</form><!-- Company info form -->
<hr/>
<form action="{{ route('emp.profile.updatepass')}}" class="company-info-form" method="post"enctype="multipart/form-data" class="login" >
    @csrf
    <div class="row align-items-center">
        <div class="col-md-9">

            <div class="row">
                <div class="col-sm-12 input-row mb-4">
                    <label for="password">Indtast ny adgangskode</label>
                    <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Indtast ny adgangskode" readonly onfocus="this.removeAttribute('readonly');" />
                    @error('password')
                    <span class="text-tenger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-sm-12 input-row mb-4">
                    <label for="password_confirmation">{{__('Confirm Password')}}</label>
                    <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password"  placeholder="{{__('Confirm Password')}}" readonly onfocus="this.removeAttribute('readonly');"/>
                    @error('password_confirmation')
                    <span class="text-tenger">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-sm-12 btn-row">
                    <button type="submit" class="btn btn-blue">Bekræft</button>
                </div>
            </div>

        </div>


    </div>

</form>
@endsection
