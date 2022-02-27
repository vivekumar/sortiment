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
						  <img src="<?php echo e(asset('backend/images/logo-dark.png')); ?>" alt="">
						  <h3><b>Sortiment</b> Shop</h3>
					 </div>
				</a>
			</div>
        </div>

      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">

		<li class="<?php echo e(($route=='admin.dashboard')?'active':''); ?>">
          <a href="<?php echo e(url('admin/dashboard')); ?>">
            <i data-feather="pie-chart"></i>
			<span>Dashboard</span>
          </a>
        </li>

        <li class="treeview <?php echo e(($route=='all.category')?'active':''); ?>" >
          <a href="#">
            <i data-feather="file"></i>
            <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'all.category')? 'active':''); ?>"><a href="<?php echo e(route('all.category')); ?>"><i class="ti-more"></i>All Category</a></li>
            <li class="<?php echo e(($route == 'all.subcategory')? 'active':''); ?>"><a href="<?php echo e(route('all.subcategory')); ?>"><i class="ti-more"></i>All Sub Category</a></li>
          </ul>
        </li>
        <li class="treeview <?php echo e(($prefix=='/sample-product')?'active':''); ?>">
          <a href="#">
            <i data-feather="file"></i> <span>Sample Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'add.product')? 'active':''); ?>"><a href="<?php echo e(route('add.product')); ?>"><i class="ti-more"></i>Add Products</a></li>
            <li class="<?php echo e(($route == 'all.product')? 'active':''); ?>"><a href="<?php echo e(route('all.product')); ?>"><i class="ti-more"></i>Manage Products</a></li>

          </ul>
        </li>
        <li class="treeview <?php echo e(($prefix=='/customize-product')?'active':''); ?>">
          <a href="#">
            <i data-feather="file"></i> <span>Customize Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'add.cproduct')? 'active':''); ?>"><a href="<?php echo e(route('add.cproduct')); ?>"><i class="ti-more"></i>Add Products</a></li>
            <li class="<?php echo e(($route == 'all.cproduct')? 'active':''); ?>"><a href="<?php echo e(route('all.cproduct')); ?>"><i class="ti-more"></i>Manage Products</a></li>

          </ul>
        </li>
        <li class="treeview <?php echo e(($route=='all.brand')?'active':''); ?>" >
          <a href="#">
            <i data-feather="file"></i>
            <span>Brand</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'all.brand')? 'active':''); ?>"><a href="<?php echo e(route('all.brand')); ?>"><i class="ti-more"></i>All Brand</a></li>

          </ul>
        </li>
        <li class="treeview <?php echo e(($prefix=='/attribute')?'active':''); ?>" >
          <a href="#">
            <i data-feather="message-circle"></i>
            <span>Attributes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'all.attribute')? 'active':''); ?>"><a href="<?php echo e(route('all.attribute')); ?>"><i class="ti-more"></i>All Attribute</a></li>

          </ul>
        </li>
        <li class="treeview <?php echo e(($prefix=='/company')?'active':''); ?>">
          <a href="#">
            <i data-feather="file"></i> <span>Company</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'all.company')? 'active':''); ?>"><a href="<?php echo e(route('all.company')); ?>"><i class="ti-more"></i>All Company</a></li>
            <li class="<?php echo e(($route == 'all.employee')? 'active':''); ?>"><a href="<?php echo e(route('all.employee')); ?>"><i class="ti-more"></i>All Employee</a></li>
          </ul>
        </li>
        <li class="treeview <?php echo e(($prefix=='/price-request')?'active':''); ?>">
          <a href="#">
            <i data-feather="file"></i> <span>Request A Price</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="<?php echo e(($route == 'companyp.pending')? 'active':''); ?>"><a href="<?php echo e(route('companyp.pending')); ?>"><i class="ti-more"></i>Company Request</a></li>

          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i data-feather="mail"></i> <span>Orders</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href=""><i class="ti-more"></i>All Orders</a></li>
          </ul>
        </li>
        <li class="treeview">
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
        </li>

        <li class="treeview<?php echo e(($route == 'admin.default.message' || $route == 'admin.ask.qustion') ? ' menu-open' : ''); ?>">
          <a href="#">
            <i data-feather="help-circle"></i>
            <span>Ask Question</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu" <?php if($route == 'admin.default.message' || $route == 'admin.ask.qustion'): ?> style="display: block;" <?php endif; ?>>
            <li class="<?php echo e(($route == 'admin.default.message') ? 'active':''); ?>"><a href="<?php echo e(route('admin.default.message')); ?>"><i class="ti-more"></i>Default Message</a></li>
            <li class="<?php echo e(($route == 'admin.ask.qustion') ? 'active':''); ?>"><a href="<?php echo e(route('admin.ask.qustion')); ?>"><i class="ti-more"></i>Questions</a></li>
          </ul>
        </li>

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







      </ul>
    </section>

	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>
<?php /**PATH /var/www/html/sortiment/resources/views/admin/body/sidebar.blade.php ENDPATH**/ ?>