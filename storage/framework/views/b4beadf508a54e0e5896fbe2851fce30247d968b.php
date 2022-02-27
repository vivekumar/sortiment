<?php
  $prefix=Request::route()->getPrefix();
  $route=Route::current()->getName();

?>
<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
			<div class="ulogo">
				 <a href="<?php echo e(url('admin/dashboard')); ?>">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">
						  <img src="<?php echo e(asset('backend/images/logo-light.png')); ?>" alt="" style="height:40px; width:auto">
						  <h3><img src="<?php echo e(asset('backend/images/logo.png')); ?>" alt="" style="height:20px; width:auto"></h3>
					 </div>
				</a>
			</div>
        </div>

      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">

		<li class="<?php echo e(($route=='admin.dashboard')?'active':''); ?>">
          <a href="<?php echo e(url('admin/dashboard')); ?>">
            <i data-feather="pie-chart"></i>
			<span><?php echo e(__('Dashboard')); ?></span>
          </a>
        </li>

        
        <li class="treeview <?php echo e(($prefix=='/sample-product')?'active':''); ?>">
          <a href="#">
            <i data-feather="home"></i> <span><?php echo e(__('Sample Product')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'add.product')? 'active':''); ?>"><a href="<?php echo e(route('add.product')); ?>"><i class="ti-more"></i><?php echo e(__('Add Sample Product')); ?></a></li>
            <li class="<?php echo e(($route == 'all.product')? 'active':''); ?>"><a href="<?php echo e(route('all.product')); ?>"><i class="ti-more"></i><?php echo e(__('Manage sample products')); ?></a></li>            
            <li class="<?php echo e(($route == 'all.category')? 'active':''); ?>"><a href="<?php echo e(route('all.category')); ?>"><i class="ti-more"></i><?php echo e(__('All Category')); ?></a></li>
            <li class="<?php echo e(($route == 'all.subcategory')? 'active':''); ?>"><a href="<?php echo e(route('all.subcategory')); ?>"><i class="ti-more"></i><?php echo e(__('All Sub Category')); ?></a></li>
            <li class="<?php echo e(($route == 'all.brand')? 'active':''); ?>"><a href="<?php echo e(route('all.brand')); ?>"><i class="ti-more"></i><?php echo e(__('All Brand')); ?></a></li>
            <li class="<?php echo e(($route == 'all.attribute')? 'active':''); ?>"><a href="<?php echo e(route('all.attribute')); ?>"><i class="ti-more"></i><?php echo e(__('All Attribute')); ?></a></li>
            <li class="<?php echo e(($route == 'all.position')? 'active':''); ?>"><a href="<?php echo e(route('all.position')); ?>"><i class="ti-more"></i><?php echo e(__('All Positions')); ?></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo e(($prefix=='/customize-product')?'active':''); ?>">
          <a href="#">
            <i data-feather="grid"></i> <span><?php echo e(__('Customize Product')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'add.cproduct')? 'active':''); ?>"><a href="<?php echo e(route('add.cproduct')); ?>"><i class="ti-more"></i><?php echo e(__('Add Products')); ?></a></li>
            <li class="<?php echo e(($route == 'all.cproduct')? 'active':''); ?>"><a href="<?php echo e(route('all.cproduct')); ?>"><i class="ti-more"></i><?php echo e(__('Manage Products')); ?></a></li>

          </ul>
        </li>
        
        <li class="treeview <?php echo e(($prefix=='/company')?'active':''); ?>">
          <a href="#">
            <i data-feather="users"></i> <span><?php echo e(__('Company')); ?></span>
            <span class="pull-right-container">
              <span class="badge badge-info" style="background:#1F39D4"><?php echo e(\App\Models\User::where('approved_at',NULL)->count()); ?></span>
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'all.company')? 'active':''); ?>"><a href="<?php echo e(route('all.company')); ?>"><i class="ti-more"></i><?php echo e(__('All Company')); ?></a></li>
            <li class="<?php echo e(($route == 'all.employee')? 'active':''); ?>"><a href="<?php echo e(route('all.employee')); ?>"><i class="ti-more"></i><?php echo e(__('All Employee')); ?></a></li>
          </ul>
        </li>
        <li class="treeview <?php echo e(($prefix=='/price-request')?'active':''); ?>">
          <a href="#">
            <i data-feather="file-text"></i> <span><?php echo e(__('Customer inquiry')); ?></span>
            <span class="pull-right-container">
               <?php 
                $startDate = \Carbon\Carbon::now()->subDays(30);
                $endDate = \Carbon\Carbon::now();
              ?>
              <span class="badge badge-info" style="background:#1F39D4"><?php echo e(\App\Models\PriceRequest::whereBetween('created_at',[$startDate, $endDate])->count()); ?></span>
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'companyp.pending')? 'active':''); ?>"><a href="<?php echo e(route('companyp.pending')); ?>"><i class="ti-more"></i><?php echo e(__('Company Request')); ?></a></li>

          </ul>
        </li>
        <li class="treeview <?php echo e(($prefix=='/order')?'active':''); ?>">
          <a href="#">
            <i data-feather="inbox"></i> <span><?php echo e(__('Orders')); ?></span>
            <span class="pull-right-container">
              <span class="badge badge-info" style="background:#1F39D4"><?php echo e(\App\Models\Order::where('status','<>','Order delivered')->count()); ?></span>
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'all.order')? 'active':''); ?>"><a href="<?php echo e(route('all.order')); ?>"><i class="ti-more"></i><?php echo e(__('All Orders')); ?></a></li>
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
        
        <li class="treeview <?php echo e(($prefix=='/chat-setting')?'active':''); ?>">
          <a href="#">
            <i data-feather="help-circle"></i>
            <span><?php echo e(__('Guide')); ?></span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" >
            <li class="<?php echo e(($route == 'view.chat.setting') ? 'active':''); ?>"><a href="<?php echo e(route('view.chat.setting')); ?>"><i class="ti-more"></i><?php echo e(__('Indstillinger')); ?></a></li>

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

  </aside>
<?php /**PATH /var/www/html/laravel/sortiment/resources/views/admin/body/sidebar.blade.php ENDPATH**/ ?>