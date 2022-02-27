@extends('company.main_master')
@section('content')
<div class="employee-wrap">
    <div class="info-title">
        <h2>{{__('Edit Employee')}} <span>{{ $employee->name }}</span>
            <div class="btn-group save-back-btn">
                <button class="btn btn-success" form="form-employee" type="submit" title="Save">
                    <i class="fas fa-save"></i>
                </button>
                <a class="btn btn-danger" href="{{ url('/company/your-employees/') }}" title="Cancel">
                    <i class="fas fa-reply"></i>
                </a>
            </div>
        </h2>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ url('/company/edit-employee/' . $employee->id) }}" method="POST" id="form-employee" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group row mb-3 cus_row">
                    <label for="input-name" class="col-sm-2 col-form-label text-end">{{__('Name')}}</label>
                    <div class="col-sm-10">
                      <input name="name" type="text" class="form-control" id="input-name" placeholder="{{__('Employee Name')}}" value="{{ $employee->name }}">
                      @isset($error['name'])
                        <div class="text-danger">{{ $error['name'] }}</div>
                      @endisset
                    </div>
                </div>
                <div class="form-group row mb-3 cus_row">
                    <label for="input-email" class="col-sm-2 col-form-label text-end">{{__('Email')}}</label>
                    <div class="col-sm-10">
                        <input name="email" type="email" class="form-control" id="input-email" placeholder="{{__('Email')}}" value="{{ $employee->email }}">
                        @isset($error['email'])
                            <div class="text-danger">{{ $error['email'] }}</div>
                        @endisset
                    </div>
                </div>
                <div class="form-group row mb-3 cus_row">
                    <label for="input-image" class="col-sm-2 col-form-label text-end">{{__('Profile Photo')}}</label>
                    <div class="col-sm-10">
                        @php
                         if ($employee->profile_photo_path && is_file(public_path('/') . $employee->profile_photo_path)) {
                             $image = asset($employee->profile_photo_path);
                         } else {
                            $image = asset('frontend/assets/img/user.png');
                         }
                        @endphp

                        <img src="{{ $image }}" alt="profile-photo" width="100" height="100" style="border-radius: 50%;" id="image-preview">
                        <input type="file" class="d-none" id="input-image" name="profile_photo_path">
                        <button type="button" class="btn btn-info" id="button-image" onclick="document.getElementById('input-image').click()" data-toggle="tooltip" title="Click to upload">
                            <i class="fas fa-upload"></i>
                        </button>
                    </div>
                </div>
                <div class="form-group row mb-3 cus_row">
                    <label for="input-password" class="col-sm-2 col-form-label text-end">{{__('Password')}}</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" id="input-password" placeholder="{{__('Password')}}" aria-label="Password" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button" onclick="passwordTypeToggle(this, 'input-password')">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                              </button>
                            </div>
                        </div>
                        @isset($error['password'])
                            <div class="text-danger">{{ $error['password'] }}</div>
                        @endisset
                    </div>
                </div>
                <div class="form-group row mb-3 cus_row">
                    <label for="input-confirm-password" class="col-sm-2 col-form-label text-end">{{__('Confirm Password')}}</label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input type="password" name="confirm_password" class="form-control" id="input-confirm-password" placeholder="{{__('Confirm Password')}}" aria-label="Password" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                              <button class="btn btn-outline-secondary" type="button" onclick="passwordTypeToggle(this, 'input-confirm-password')">
                                <i class="fas fa-eye" aria-hidden="true"></i>
                              </button>
                            </div>
                        </div>
                        @isset($error['confirm_password'])
                            <div class="text-danger">{{ $error['confirm_password'] }}</div>
                        @endisset
                    </div>
                </div>
                <div class="form-group row mb-3 cus_row">
                    <label for="input-email" class="col-sm-2 col-form-label text-end">{{__('Status')}}</label>
                    <div class="col-sm-10">
                        <div class="switch colored">
                            <input type="checkbox" id="colored" value="1" name="status" @if ($employee->status==1) checked @endif>
                              <label for="colored"></label>
                          </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    (() => {
        document.getElementById('input-image').addEventListener('change', (event) => {
            const preview = document.querySelector('#image-preview');
            const file = event.target.files[0];
            console.log(file);
            const reader = new FileReader();
            reader.addEventListener("load", function () {
                preview.src = reader.result;
            }, false);
            if (file) {
                reader.readAsDataURL(file);
            }
        });
    })();
</script>
@endsection
