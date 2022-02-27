@php
  $prefix=Request::route()->getPrefix();
  $route=Route::current()->getName();
@endphp
<aside class="product-sidebar">
    <ul class="sidebar-menu">
        <li><a href="{{route('emp.shop')}}" class="{{ ($route == 'emp.shop')? 'active':'' }}"><i class="fas fa-tshirt"></i> {{__('My products')}}</a></li>
        <li><a href="{{route('emp.profile')}}" class="{{ ($route == 'emp.profile')? 'active':'' }}"><i class="fas fa-tshirt"></i> {{__('My profile')}}</a></li>
        <li><a href="{{route('emp.askAquestion')}}" class="{{ ($route == 'emp.askAquestion')? 'active':'' }}"><i class="fas fa-question"></i> {{__('Ask a question')}}</a></li>
    </ul>
    <div class="sidebar-contact-info text-center">
        <ul>
            <li>
                <p>Sortiment ApS<br> Hansborggade 30, 6100 Haderslev</p>
            </li>
            <li>
                <p>Tlf: <strong>41 88 80 80</strong></p>
                <p>Kontakt: <a href="mailto:info@sortiment.dk"><strong>info@sortiment.dk</strong></a></p>
            </li>
            <li>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
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
