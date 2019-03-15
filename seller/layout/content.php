 <!-- Main content -->
 <section class="content">
<?php 
if(isset($_REQUEST['content'])){
    $file = $_REQUEST['content'].'.php';
    include_once $file;
}
else{
    include_once 'dashboard.php';
}
?>
</section>