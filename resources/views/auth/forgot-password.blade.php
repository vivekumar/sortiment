<x-guest-layout>
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


                <form method="POST" action="{{ route('password.email') }}" class="login">
                    <x-jet-validation-errors class="mb-4" />
                    <h2 class="main-heading">{{__('Reset password')}}</h2>
                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>
                    @if (session('status'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                     @csrf

                    <div class="row">
                        <div class="col-sm-12 input-row mb-4">
                            <span class="input-icon"><img src="{{ asset('frontend/assets/img/envelope-solid.png') }}" alt="" width="25"></span>
                          <input type="email" name="email" :value="old('email')"  class="form-control required" placeholder="{{__('Enter email address')}}" required autofocus>
                        </div>

                        <div class="col-sm-12 btn-row">
                            <button type="submit" class="btn btn-blue f-width toggle-disabled" disabled>{{__('Email Password Reset Link')}}</button>
                        </div>
                    </div>
                </form><!-- Login form -->

            </div><!-- Right col -->
        </div><!-- Form wrapper -->
    </div><!-- Main wrapper -->
</x-guest-layout>
{{--
<x-guest-layout>

    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
--}}
