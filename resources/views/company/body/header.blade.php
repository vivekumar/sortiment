<header class="header d-flex justify-content-between align-items-center sticky-top">
    <div class="head-left d-flex align-items-center">

        <a href="{{url('/')}}" class="logo"><img src="{{asset('frontend/assets/img/Sortiment logo.svg') }}" alt="logo"></a>
        <div class="search">
            <form action="{{route('dashboard')}}">
                <button type="submit" href="#" class="search-icon"><img src="{{asset('frontend/assets/img/search-solid.svg') }}" alt="search"></button>
                <input type="text" class="form-control" placeholder="{{__('Search for a product')}}…" name="s" value="{{@$_GET['s']}}">
            </form>
        </div>

    </div><!-- Header left -->
    <div class="head-right d-flex align-items-center">
        <div class="minicart">
            @php
                $formatter = new NumberFormatter('de_DE',  NumberFormatter::CURRENCY);
            @endphp
            <a href="javascript:void(0);" class="cart-icon" id="cart_popup">
                <span>
                    <img src="{{asset('frontend/assets/img/shopping-cart-solid.svg') }}" alt="">
                    <small class="cart-badge">{{Cart::count()}}</small>
                </span>
                <small class="carttext">{{$formatter->formatCurrency(Cart::total(), 'DKK'), PHP_EOL;}} {{__('In cart')}}</small>
            </a>
        </div><!-- Minicart -->
        <!-- shopping-cart -->
        <div class="shopping-cart" style="display: none;">
            <div class="close-cart"> <i class="fa fa-times"></i></div>
            <div class="shopping-cart-header">
                <i class="fa fa-shopping-cart cart-icon"></i><span class="badge">{{Cart::count()}}</span>
                <div class="shopping-cart-total">
                    <div class="shop">&nbsp;{{--Shopping cart--}}</div>
                <span class="lighter-text">Total:</span>
                <span class="main-color-text">{{$formatter->formatCurrency(Cart::total(), 'DKK'), PHP_EOL;}}</span>


                </div>
            </div> <!--end shopping-cart-header -->

            <ul class="shopping-cart-items">
              @foreach(Cart::content() as $row)
                <li class="clearfix">
                <a href="#"><img src="{{ asset(($row->options->has('image') ? $row->options->image : ''))}}" alt="item1" /></a>
                <a href="#">
                    <span class="item-name">{{$row->name}}</span>
                    <span class="item-price">{{$formatter->formatCurrency($row->price, 'DKK'), PHP_EOL;}}</span>
                    <span class="item-quantity">{{__('Quantity')}}: {{$row->qty}}</span>
                </a>
                <div class="remove-trash"> <a href="{{route('cart.delete',$row->rowId)}}"><i class="fa fa-trash"></i></a></div>
                </li>
                @endforeach
            </ul>
            @if(Cart::content()->count()>0)
            <div class="checkout-btn">
                <a href="{{route('view.cart')}}" class="button">Kasse</a>
            </div>
            @endif
        </div> <!--end shopping-cart -->
        @php
			//$userData=DB::table('users')->find(Auth::user()->id);
            $name=explode(' ',Auth::user()->name)
		  @endphp
        <div class="head-user-name">
            <a href="{{route('companyInfo')}}">
                <span class="username">{{__('Welcome')}} {{$name[0]}}</span>
                <img class="user-img" src="{{asset(Auth::user()->profile_photo_path?Auth::user()->profile_photo_path:'frontend/assets/img/user.png') }}" width="50px" alt="user picture">
            </a>
        </div><!-- Head user name -->
    </div><!-- Header right -->

    <!-- burgermenu -->
    <div class="burgermenu">
        <div class="hamburger open">
            <img src="{{asset('frontend/assets/img/burgermenu-black.png') }}" alt="">
        </div>
    </div><!-- burgermenu -->
</header><!-- Header -->
