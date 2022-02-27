@php
  $prefix=Request::route()->getPrefix();
  $route=Route::current()->getName();

@endphp
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
			<div class="ulogo">
				 <a href="{{ url('admin/dashboard')}}">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">
						  <img src="{{ asset('backend/images/logo-light.png')}}" alt="" style="height:40px; width:auto">
						  <h3><img src="{{ asset('backend/images/logo.png')}}" alt="" style="height:20px; width:auto"></h3>
					 </div>
				</a>
			</div>
        </div>

      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">

		<li class="{{ ($route=='admin.dashboard')?'active':''}}">
          <a href="{{ url('admin/dashboard')}}">
            <i data-feather="pie-chart"></i>
			<span>{{__('Dashboard')}}</span>
          </a>
        </li>

        {{--<li class="treeview {{ ($route=='all.category')?'active':''}}" >
          <a href="#">
            <i data-feather="trello"></i>
            <span>{{__('Category')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'all.category')? 'active':'' }}"><a href="{{ route('all.category')}}"><i class="ti-more"></i>{{__('All Category')}}</a></li>
            <li class="{{ ($route == 'all.subcategory')? 'active':'' }}"><a href="{{ route('all.subcategory')}}"><i class="ti-more"></i>{{__('All Sub Category')}}</a></li>
          </ul>
        </li>--}}
        <li class="treeview {{ ($prefix=='/sample-product')?'active':''}}">
          <a href="#">
            <i data-feather="home"></i> <span>{{__('Sample Product')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'add.product')? 'active':'' }}"><a href="{{ route('add.product') }}"><i class="ti-more"></i>{{__('Add Sample Product')}}</a></li>
            <li class="{{ ($route == 'all.product')? 'active':'' }}"><a href="{{ route('all.product') }}"><i class="ti-more"></i>{{__('Manage sample products')}}</a></li>            
            <li class="{{ ($route == 'all.category')? 'active':'' }}"><a href="{{ route('all.category')}}"><i class="ti-more"></i>{{__('All Category')}}</a></li>
            <li class="{{ ($route == 'all.subcategory')? 'active':'' }}"><a href="{{ route('all.subcategory')}}"><i class="ti-more"></i>{{__('All Sub Category')}}</a></li>
            <li class="{{ ($route == 'all.brand')? 'active':'' }}"><a href="{{ route('all.brand')}}"><i class="ti-more"></i>{{__('All Brand')}}</a></li>
            <li class="{{ ($route == 'all.attribute')? 'active':'' }}"><a href="{{ route('all.attribute')}}"><i class="ti-more"></i>{{__('All Attribute')}}</a></li>
            <li class="{{ ($route == 'all.position')? 'active':'' }}"><a href="{{ route('all.position')}}"><i class="ti-more"></i>{{__('All Positions')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ ($prefix=='/customize-product')?'active':''}}">
          <a href="#">
            <i data-feather="grid"></i> <span>{{__('Customize Product')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'add.cproduct')? 'active':'' }}"><a href="{{ route('add.cproduct') }}"><i class="ti-more"></i>{{__('Add Products')}}</a></li>
            <li class="{{ ($route == 'all.cproduct')? 'active':'' }}"><a href="{{ route('all.cproduct') }}"><i class="ti-more"></i>{{__('Manage Products')}}</a></li>

          </ul>
        </li>
        {{--<li class="treeview {{ ($route=='all.brand')?'active':''}}" >
          <a href="#">
            <i data-feather="globe"></i>
            <span>{{__('Brand')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'all.brand')? 'active':'' }}"><a href="{{ route('all.brand')}}"><i class="ti-more"></i>{{__('All Brand')}}</a></li>

          </ul>
        </li>
        <li class="treeview {{ ($prefix=='/attribute')?'active':''}}" >
          <a href="#">
            <i data-feather="layers"></i>
            <span>{{__('Attributes')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'all.attribute')? 'active':'' }}"><a href="{{ route('all.attribute')}}"><i class="ti-more"></i>{{__('All Attribute')}}</a></li>

          </ul>
        </li>--}}
        <li class="treeview {{ ($prefix=='/company')?'active':''}}">
          <a href="#">
            <i data-feather="users"></i> <span>{{__('Company')}}</span>
            <span class="pull-right-container">
              <span class="badge badge-info" style="background:#1F39D4">{{\App\Models\User::where('approved_at',NULL)->count()}}</span>
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'all.company')? 'active':'' }}"><a href="{{route('all.company')}}"><i class="ti-more"></i>{{__('All Company')}}</a></li>
            <li class="{{ ($route == 'all.employee')? 'active':'' }}"><a href="{{route('all.employee')}}"><i class="ti-more"></i>{{__('All Employee')}}</a></li>
          </ul>
        </li>
        <li class="treeview {{ ($prefix=='/price-request')?'active':''}}">
          <a href="#">
            <i data-feather="file-text"></i> <span>{{__('Customer inquiry')}}</span>
            <span class="pull-right-container">
               @php 
                $startDate = \Carbon\Carbon::now()->subDays(30);
                $endDate = \Carbon\Carbon::now();
              @endphp
              <span class="badge badge-info" style="background:#1F39D4">{{\App\Models\PriceRequest::whereBetween('created_at',[$startDate, $endDate])->count()}}</span>
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'companyp.pending')? 'active':'' }}"><a href="{{route('companyp.pending')}}"><i class="ti-more"></i>{{__('Company Request')}}</a></li>

          </ul>
        </li>
        <li class="treeview {{ ($prefix=='/order')?'active':''}}">
          <a href="#">
            <i data-feather="inbox"></i> <span>{{__('Orders')}}</span>
            <span class="pull-right-container">
              <span class="badge badge-info" style="background:#1F39D4">{{\App\Models\Order::where('status','<>','Order delivered')->count()}}</span>
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'all.order')? 'active':'' }}"><a href="{{ route('all.order') }}"><i class="ti-more"></i>{{__('All Orders')}}</a></li>
          </ul>
        </li>
        <!--<li class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="ti-more"></i>Profile</a></li>
            <li><a href=""><i class="ti-more"></i>Invoice</a></li>
            <li><a href=""><i class="ti-more"></i>Gallery</a></li>
            <li><a href=""><i class="ti-more"></i>FAQs</a></li>
            <li><a href=""><i class="ti-more"></i>Timeline</a></li>
          </ul>
        </li>-->
        {{--
        <li class="treeview {{ ($route=='all.positions')?'active':''}}" >
          <a href="#">
            <i data-feather="trello"></i>
            <span>{{__('Logo Positions')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route == 'all.position')? 'active':'' }}"><a href="{{ route('all.position')}}"><i class="ti-more"></i>{{__('All Positions')}}</a></li>

          </ul>
        </li>
        

        <li class="treeview{{ ($route == 'admin.default.message' || $route == 'admin.ask.qustion') ? ' menu-open' : '' }}">
          <a href="#">
            <i data-feather="help-circle"></i>
            <span>{{__('Ask a question')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" @if ($route == 'admin.default.message' || $route == 'admin.ask.qustion') style="display: block;" @endif>
            <!--<li class="{{ ($route == 'admin.default.message') ? 'active':'' }}"><a href="{{ route('admin.default.message') }}"><i class="ti-more"></i>{{__('Default Message')}}</a></li>-->
            <li class="{{ ($route == 'admin.ask.qustion') ? 'active':'' }}"><a href="{{ route('admin.ask.qustion') }}"><i class="ti-more"></i>{{__('Questions')}}</a></li>
          </ul>
        </li>--}}
        <li class="treeview {{ ($prefix=='/chat-setting')?'active':''}}">
          <a href="#">
            <i data-feather="help-circle"></i>
            <span>{{__('Guide')}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li class="{{ ($route == 'view.chat.setting') ? 'active':'' }}"><a href="{{ route('view.chat.setting') }}"><i class="ti-more"></i>{{__('Indstillinger')}}</a></li>

          </ul>
        </li>
        <!--
        <li class="header nav-small-cap">User Interface</li>

        <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Components</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="ti-more"></i>Alerts</a></li>

          </ul>
        </li>

		<li class="treeview">
          <a href="#">
            <i data-feather="credit-card"></i>
            <span>Cards</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href=""><i class="ti-more"></i>Advanced Cards</a></li>
			<li><a href=""><i class="ti-more"></i>Basic Cards</a></li>
			<li><a href=""><i class="ti-more"></i>Cards Color</a></li>
		  </ul>
        </li>
-->






      </ul>
    </section>
{{--
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  --}}
  </aside>
