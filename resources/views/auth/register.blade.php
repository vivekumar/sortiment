@extends('layouts.guestReg')
    @section('content')
    {{--<x-guest-layout>--}}

    <div id="main-wrapper">
        <div class="form-wrapper row">
            <div class="col-md-5 left-col d-flex align-items-center flex-column justify-content-between">
                <div class="top-head text-center">
                    <h1 class="main-heading">{{__('Welcome to Sortiment')}}</h1>
                    <p>{{__('Your products are waiting for you in the shop, go login and see the products for yourself')}}.</p>
                </div><!-- Top heading -->
                <div class="mid-col text-center">
                    <a href="{{route('login')}}" class="btn bdr-btn">{{__('Log in')}}</a>
                    <p><a href="{{route('login')}}"><strong>{{__('Already have an account?')}} </strong></a>{{--__('Please login with the formular to the right')--}}</p>
                </div><!-- Middle col -->
                <div class="bot-col text-center">
                    <p>{{__('If you have any questions please contact Sortiment using')}} <strong>info@sortiment.dk  eller tlf. +45 41 88 80 80</strong></p>
                </div><!-- Bottom col -->
            </div><!-- left col -->
            <div class="col-md-7 right-col d-flex align-items-center justify-content-center">
              <form method="POST" action="{{ route('register') }}" class="login text-center">
                @csrf
                <h2 class="main-heading">{{__('Create an account')}}</h2>
                <x-jet-validation-errors class="mb-4" />
                <div class="row">
                  <div class="col-lg-6 input-row mb-4">
                      <span class="input-icon"><img src="{{ asset('frontend/assets/img/user-solid.png') }}" alt="" width="25"></span>
                    <input type="text" class="form-control required" placeholder="{{__('Name and lastname')}}" name="name" :value="old('name')" required autofocus autocomplete="name" >
                  </div>
                  <div class="col-lg-6 input-row mb-4">
                      <span class="input-icon"><img src="{{ asset('frontend/assets/img/envelope-solid.png') }}" alt="" width="25"></span>
                    <input type="email" name="email" :value="old('email')" required class="form-control required" placeholder="{{__('Email')}}">
                  </div>
                  <div class="col-lg-6 input-row mb-4">
                      <span class="input-icon"><img src="{{ asset('frontend/assets/img/building-solid.png') }}" alt="" width="25"></span>
                    <input type="text" name="company" class="form-control required" placeholder="{{__('Company name')}}">
                  </div>
                  <div class="col-lg-6 input-row  mb-4">
                      <span class="input-icon"><img src="{{ asset('frontend/assets/img/building-solid.png') }}" alt="" width="25"></span>
                    <input type="text" name="crv_number" class="form-control required" placeholder="{{__('CVR number')}}" maxlength="8">
                  </div>
                  <div class="col-lg-6 input-row  mb-4">
                      <span class="input-icon"><img src="{{ asset('frontend/assets/img/map-marker-alt-solid.png') }}" alt="" width="25"></span>
                    <input type="text" name="address" class="form-control required" placeholder="{{__('Address')}}">
                  </div>
                  <div class="col-lg-6 input-row  mb-4">
                      <span class="input-icon"><img src="{{ asset('frontend/assets/img/map-marker-alt-solid.png') }}" alt="" width="25"></span>
                    <input type="text" name="city" class="form-control required" placeholder="{{__('City')}}">
                  </div>
                  <div class="col-lg-6 input-row mb-5">
                      <span class="input-icon"><img src="{{ asset('frontend/assets/img/key-solid.png') }}" alt="" width="25"></span>
                    <input type="password" name="password" required autocomplete="new-password" class="form-control required" placeholder="{{__('Password')}}">
                  </div>
                  <div class="col-lg-6 input-row mb-5">
                    <!--<x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />-->
                    <span class="input-icon"><img src="{{ asset('frontend/assets/img/key-solid.png') }}" alt="" width="25"></span>
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full form-control" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="{{__('Confirm Password')}}" />
                  </div>
                  <div class="col-sm-12 btn-row">
                      <button type="submit" class="btn btn-blue f-width toggle-disabled" disabled>{{__('Create account')}}</button>
                      <p><a href="{{route('login')}}">{{__('Login here')}}</a></p>
                  </div>
                </div>
              </form><!-- Login form -->
          </div><!-- Right col -->
        </div><!-- Form wrapper -->
    </div><!-- Main wrapper -->

    {{--
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Name') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>

</x-guest-layout>
--}}
@endsection
