    @extends('layouts.guestLogin')
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
                    <a href="{{route('register')}}" class="btn bdr-btn">{{__('Create account')}}</a>
                    <p><a href="{{route('login')}}"><strong>{{__('Already have an account?')}} </strong></a>{{--__('Please login with the formular to the right')--}}</p>
                </div><!-- Middle col -->
                <div class="bot-col text-center">
                    <p>{{__('If you have any questions please contact Sortiment using')}} <strong>info@sortiment.dk  eller tlf. +45 41 88 80 80</strong></p>
                </div><!-- Bottom col -->
            </div><!-- left col -->
            <div class="col-md-7 right-col d-flex align-items-center justify-content-center">


                <form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}" class="login text-center">
                    <x-jet-validation-errors class="mb-4" />
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                     @csrf
                    <h2 class="main-heading">{{__('Log in')}}</h2>
                    <div class="row">
                        <div class="col-sm-12 input-row mb-4">
                            <span class="input-icon"><img src="{{ asset('frontend/assets/img/user-solid.png') }}" alt="" width="25"></span>
                          <input type="email" name="email" :value="old('email')"  class="form-control required" placeholder="{{__('Enter username or email address')}}" required autofocus>
                        </div>
                        <div class="col-sm-12 input-row mb-5">
                            <span class="input-icon"><img src="{{ asset('frontend/assets/img/key-solid.png') }}" alt="" width="25"></span>
                          <input type="password" name="password" required autocomplete="current-password" class="form-control required" placeholder="{{__('Enter password')}}">
                        </div>
                        <div class="col-sm-12 btn-row">
                            <button type="submit" class="btn btn-blue f-width toggle-disabled" disabled>{{__('Log in')}}</button>
                            <p><a href="{{route('register')}}">{{__('Create account')}}</a></p>
                            <p>@if (Route::has('password.request'))
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            @endif</p>
                        </div>
                    </div>
                </form><!-- Login form -->
            </div><!-- Right col -->
        </div><!-- Form wrapper -->
    </div><!-- Main wrapper -->
{{--</x-guest-layout>--}}

{{--
<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ isset($guard) ? url($guard.'/login') : route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
--}}
@endsection
