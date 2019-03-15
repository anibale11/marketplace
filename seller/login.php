<!DOCTYPE html>
<html>
  <?php include 'layout/header/head.php' ?>
  <?php session_start(); 
        if(isset($_SESSION['email']) && isset($_SESSION['islogined'])){
         header("Location: http://localhost/magento23/seller/index.php");
        } 
  ?>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="index2.html"><b>Admin</b>LTE</a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="http://localhost/magento23/marketplace/vendor/login" method="GET">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" name="email" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="password" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

        <a href="#">I forgot my password</a><br>
        <a href="http://localhost/magento23/marketplace/" class="text-center">Register a new membership</a>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="http://localhost/magento23/seller/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="http://localhost/magento23/seller/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="http://localhost/magento23/seller/plugins/iCheck/icheck.min.js"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>
