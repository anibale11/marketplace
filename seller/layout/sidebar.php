 <!-- Left side column. contains the logo and sidebar -->
 <aside class="main-sidebar">

<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">

  <!-- Sidebar user panel (optional) -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="<?php echo "http://localhost/magento23/pub/media/seller/".$vendor->getVendorLogo(); ?>" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p> <?php echo $vendor->getStoreName(); ?></p>
    </div>
  </div>

  <!-- Sidebar Menu -->
  <ul class="sidebar-menu">
    <!-- Optionally, you can add icons to the links -->
    <li class="active"><a href="http://localhost/magento23/seller"><i class="fa fa-link"></i> <span>Dashboard</span></a></li>
    <li><a href="http://localhost/magento23/seller/index.php?content=profile"><i class="fa fa-link"></i> <span>My Profile</span></a></li>
    <li><a href="http://localhost/magento23/seller/index.php?content=product"><i class="fa fa-link"></i> <span>Products</span></a></li>
    <li><a href="http://localhost/magento23/seller/index.php?content=orders"><i class="fa fa-link"></i> <span>Orders</span></a></li>
    <li><a href="http://localhost/magento23/seller/index.php?content=transactions"><i class="fa fa-link"></i> <span>Transactions</span></a></li>
  </ul><!-- /.sidebar-menu -->
</section>
<!-- /.sidebar -->
</aside>