<header class="header d-flex justify-content-between align-items-center sticky-top">
    <div class="head-left d-flex align-items-center">
        <a href="{{url('/')}}" class="logo"><img src="{{asset('frontend/assets/img/Sortiment logo.svg') }}" alt="logo"></a>
        <div class="search">
            <form action="{{route('emp.shop')}}">
                <button type="submit" href="#" class="search-icon"><img src="{{asset('frontend/assets/img/search-solid.svg') }}" alt="search"></button>
                <input type="text" class="form-control" placeholder="{{__('Search for a product')}}…" name="s" value="{{@$_GET['s']}}">
            </form>
        </div>
    </div><!-- Header left -->
    <div class="head-right d-flex align-items-center">
        <!--<div class="minicart">
            <a href="#" class="cart-icon">
                <span>
                    <img src="{{asset('frontend/assets/img/shopping-cart-solid.png') }}" alt="">
                    <small class="cart-badge">0</small>
                </span>
                <small class="carttext">0,00 DKK In cart</small>
            </a>
        </div>--><!-- Minicart -->
        @php
            $name=explode(' ',Auth::user()->name)
        @endphp
        <div class="head-user-name">
            <a href="{{route('emp.profile')}}">
                <span class="username">{{__('Welcome')}} {{$name[0]}}</span>
                <img class="user-img" src="{{asset(Auth::user()->profile_photo_path?Auth::user()->profile_photo_path:'frontend/assets/img/user.png') }}" width="50px" alt="user picture">
            </a>
        </div><!-- Head user name -->
    </div><!-- Header right -->
</header><!-- Header -->
