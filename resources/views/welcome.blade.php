<x-guest-layout>
    <style>
        .start_pg {
            padding: 0 8%;
        }
        .start_pg {
            width: 100%;
            text-align: center;
        }

        .start_pg h3 {
            font-size: 4rem;
            color: #011ed1;
        }

        .start_pg p {
            font-size: 32px;
            color: #000;
        }

        .start_pg p span {
            font-weight: bold;
            line-height: 1.4;
        }

        .start_pg h4 {
            font-size: 28px;
            font-weight: normal;
            color: #011ed1;
        }
    </style>
    <div id="main-wrapper">
        <div class="form-wrapper approval-page row">
            <div class="col-md-5 left-col d-flex align-items-center flex-column justify-content-between">
                <div class="top-head text-center">
                    <h1 class="main-heading">{{__('Welcome to Sortiment')}}</h1>
                    <p>{{__('Your products are waiting for you in the shop, go login and see the products for yourself')}}.</p>
                </div><!-- Top heading -->
                <div class="mid-col text-center">
                <form method="POST" action="{{ url('logout')}}" >
                        @csrf
                        @if(Auth::user())
                        <a class="block btn bdr-btn" href="{{ url('/logout')}}" onclick="event.preventDefault();
                                        this.closest('form').submit();">Log ud</a>
                        @endif
                    </form>
                    <!--<a href="{{route('login')}}" class="btn bdr-btn">{{__('Log ud')}}</a>-->
                    <p><a href="{{route('login')}}"><strong>{{__('Already have an account?')}} </strong></a>{{--__('Please login with the formular to the right')--}}</p>
                </div><!-- Middle col -->
                <div class="bot-col text-center">
                    <p>{{__('If you have any questions please contact Sortiment using')}} <strong>info@sortiment.dk or 41 88 80 80</strong></p>
                </div><!-- Bottom col -->
            </div><!-- left col -->
            <div class="col-md-7 right-col d-flex align-items-center justify-content-center">
                <div class="start_pg">
                <h3>{{--__('Waiting for Approval')--}}Succes!</h3>

                <p>{{__('You are almost ready we have received your account information and your account is being reviewed. This is only to make sure you’re not a bot')}}</p>

                <p><span>{{__('A employee will look at your account momentarily and approve your account ASAP')}}</span></p>

                <h4><strong>{{__('For urgent requests')}}</strong><br>
                {{__('Phone')}}: +45 41 88 80 80</h4>

                    </div>
          </div><!-- Right col -->
        </div><!-- Form wrapper -->
    </div><!-- Main wrapper -->

    {{--
    <div class="container mt-100" style="margin-top:150px" >
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Waiting for Approval</div>

                    <div class="card-body">
                        Your account is waiting for our administrator approval.
                        <br />
                        Please check back later.

                        <form method="POST" action="{{ url('logout')}}" >
                            @csrf
                            @if(Auth::user())
                            <a class="block btn btn-default" href="{{ url('/logout')}}" onclick="event.preventDefault();
                                            this.closest('form').submit();">Log Out</a>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
</x-guest-layout>

