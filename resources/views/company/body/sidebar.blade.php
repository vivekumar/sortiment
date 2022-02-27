@php
  $prefix=Request::route()->getPrefix();
  $route=Route::current()->getName();
@endphp
<aside class="product-sidebar">
    <!-- burgermenu -->
    <div class="burgermenu">
        <div class="hamburger close">
            <img src="{{asset('frontend/assets/img/burgermenu-white.png') }}" alt="">
        </div>
    </div><!-- burgermenu -->

    <ul class="sidebar-menu">
        <li><a href="{{route('dashboard')}}" class="{{ ($route == 'dashboard')? 'active':'' }}"><i class="fas fa-shopping-cart"></i> {{__('Order products')}}</a></li>
        <li><a href="{{route('myproduct')}}" class="{{ ($route == 'myproduct')? 'active':'' }}"><i class="fas fa-tshirt"></i> {{__('My products')}}</a></li>
        <li><a href="{{route('companyInfo')}}" class="{{ ($route == 'companyInfo')? 'active':'' }}"><i class="bi bi-palette-fill"></i> {{__('Your company information')}}</a></li>
        <li><a href="{{route('yourEmployees')}}" class="{{ ($route == 'yourEmployees')? 'active':'' }}"><i class="fas fa-users"></i>{{__('Your employees')}}</a></li>
        <li><a href="{{route('orderHostory')}}" class="{{ ($route == 'orderHostory')? 'active':'' }}"><i class="fas fa-receipt"></i> {{__('Order history')}}</a></li>
        <li><a href="{{route('askAquestion')}}" class="{{ ($route == 'askAquestion')? 'active':'' }}"><i class="fas fa-question"></i> {{__('Ask a question')}}</a></li>
    </ul>
    <div class="sidebar-contact-info text-center">
        <ul>
            <li>
                <p>Sortiment ApS<br> Hansborggade 30, 6100 Haderslev</p>
            </li>
            <li>
                <p>Tlf: <strong>41 88 80 80</strong></p>
                <p>Kontakt: <a href="mailto:b2b@sortiment.dk"><strong>b2b@sortiment.dk</strong></a></p>
            </li>
            <li>
                <a href="https://www.facebook.com/sortiment.dk" target="_blank"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/sortiment.dk/?hl=da" target="_blank"><i class="fab fa-instagram"></i></a>
            </li>
        </ul>
        <ul>
            <li>
                <form method="POST" action="{{ url('logout')}}">
                    @csrf
                    @if(Auth::user())
                    <a class="block " href="{{ url('/logout')}}" onclick="event.preventDefault();
                                    this.closest('form').submit();">{{__('Log Out')}}</a>
                    @endif
                </form>

            </li>
        </ul>
    </div>
</aside><!-- Product sidebar -->
