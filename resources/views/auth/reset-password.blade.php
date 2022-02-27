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

                <form method="POST" action="{{ route('password.update') }}" class="login">
                    @csrf
                    <div class="mb-4 font-medium text-sm text-green-600">
                <x-jet-validation-errors class="mb-4" />
                </div>
                    <div class="row">
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="col-sm-12 input-row mb-4">
                            <span class="input-icon"><img src="{{ asset('frontend/assets/img/user-solid.png') }}" alt="" width="25"></span>
                          <x-jet-input id="email" class="form-control" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                        </div>
                        <div class="col-sm-12 input-row mb-4">
                            <span class="input-icon"><img src="{{ asset('frontend/assets/img/key-solid.png') }}" alt="" width="25"></span>
                            <x-jet-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" placeholder="Indtast ny adgangskode" />
                        </div>
                        <div class="col-sm-12 input-row mb-4">
                            <span class="input-icon"><img src="{{ asset('frontend/assets/img/key-solid.png') }}" alt="" width="25"></span>
                            <x-jet-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password"  placeholder="{{__('Confirm Password')}}"/>
                        </div>
                        <div class="col-sm-12 btn-row">
                            <button type="submit" class="btn btn-blue f-width toggle-disabled" >Bekræft</button>
                            </p>
                        </div>


                    </div>
                </form>


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

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
--}}
