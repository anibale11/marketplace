<?php
  //global data required in header,side bar and profile
  session_start(); 
  if(!isset($_SESSION['email']) || !isset($_SESSION['islogined'])){
    header("Location: http://localhost/magento23/seller/login.php");
  } 
  //include mage start team
  require __DIR__ . '/../../mage.php';
  $vendor = $obj->get('Magentomaster\Marketplace\Model\Vendors')->load(1);
  $formkey=$obj->get('Magento\Framework\Data\Form\FormKey')->getFormKey();
?>
 <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>B</b>K</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>BMG</b>Kart</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Notifications Menu -->
              <li class="dropdown notifications-menu">
                <!-- Menu toggle button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                    <!-- Inner Menu: contains the notifications -->
                    <ul class="menu">
                      <li><!-- start notification -->
                        <a href="#">
                          <i class="fa fa-users text-aqua"></i> You revieved two orders today
                        </a>
                      </li><!-- end notification -->
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
              </li>
            
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="<?php echo "http://localhost/magento23/pub/media/seller/".$vendor->getVendorLogo(); ?>" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs"><?php echo $vendor->getStoreName(); ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="<?php echo "http://localhost/magento23/pub/media/seller/".$vendor->getVendorLogo(); ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo $vendor->getStoreName(); ?>
                      <small>Member since <?php 
                       $date = new DateTime($vendor->getCreatedDate());
                       echo $date->format('M,Y'); // 31.07.2012  ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="http://localhost/magento23/seller/index.php?content=profile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="http://localhost/magento23/marketplace/vendor/logout" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>