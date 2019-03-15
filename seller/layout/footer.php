 <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

    <script src="http://localhost/magento23/seller/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="http://localhost/magento23/seller/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="http://localhost/magento23/seller/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="http://localhost/magento23/seller/plugins/fastclick/fastclick.min.js"></script>
    <script src="http://localhost/magento23/seller/dist/js/demo.js"></script>
    <link rel="stylesheet" href="http://localhost/magento23/seller/plugins/datatables/dataTables.bootstrap.css">
    <script>
      $(function () {
        $('#example1').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
<!-- Main Footer
   <footer class="main-footer">
        <div class="pull-right hidden-xs">
        </div>
        <strong>Copyright &copy; 2019 <a href="#">BmgKart Private Limited</a>.</strong> All rights reserved.
   </footer>
   -->