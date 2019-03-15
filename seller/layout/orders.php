<?php  $orderCollection = $obj->get('Magentomaster\Marketplace\Model\OrderitemsFactory')->create()->getCollection(); 
       $orderModel = $obj->get('Magento\Sales\Api\Data\OrderInterface');
       $data = $orderCollection->addFieldToFilter('seller_id',1);
       //echo "<pre>"; print_r($data->getData()); die('dead');
?>
<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">My Orders</h3>
        </div><!-- /.box-header -->
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            <div class="row"><div class="col-sm-6">
              <div class="dataTables_length" id="example1_length">
                <label>Show 
                <select name="example1_length" aria-controls="example1" class="form-control input-sm">
                  <option value="10">10</option><option value="25">25</option>
                  <option value="50">50</option><option value="100">100</option>
                </select> entries</label>
              </div></div><div class="col-sm-6">
                <div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
            <thead>
              <tr role="row">
                <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending">Incremented ID</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Purchase Date</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Customer Name</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Item Sku</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Item Ordered</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Currency</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Tax</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Ship Charges</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Sub Total</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Grand Total</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Status</th>
                <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >View detail</th>
              </tr>
            </thead>
            <tbody> 
            <?php foreach($data as $data) { 
                $order = $orderModel->load($data->getOrderId());
              // echo "<pre>"; print_r($order->getData());
                ?>
              <tr role="row" class="odd">
                <td class="sorting_1"><?php echo  $order->getIncrementId(); ?></td>
                <td><?php echo  $order->getCreatedAt(); ?></td>
                <td><?php echo  $order->getCustomerFirstname().' '.$order->getCustomerLastname() ?></td>
                <td><?php echo  $data->getSku(); ?></td>
                <td><?php echo  $data->getQty();?></td>
                <td><?php echo  $order->getOrderCurrencyCode(); ?></td>
                <td><?php echo  $order->getTaxAmount(); ?></td>
                <td><?php echo  $data->getShipmentAmount(); ?></td>
                <td><?php echo  $order->getSubtotal(); ?></td>
                <td><?php echo  $order->getGrandTotal(); ?></td>
                <td><?php echo  $order->getStatus(); ?></td>
                <td><a href="">Edit</a></td>
              </tr>
            <?php } ?>
            </tbody>
            <tfoot>
              <tr>
                <th rowspan="1" colspan="1">Incremented ID</th>
                <th rowspan="1" colspan="1">Purchase Date</th>
                <th rowspan="1" colspan="1">Customer Name</th>
                <th rowspan="1" colspan="1">Currency</th>
                <th rowspan="1" colspan="1">Tax</th>
                <th rowspan="1" colspan="1">Sub Total</th>
                <th rowspan="1" colspan="1">Grand Total</th>
                <th rowspan="1" colspan="1">Status</th>
                <th rowspan="1" colspan="1">View detail</th>
              </tr>
            </tfoot>
        </div><!-- /.box-body -->
      </div>
    </div>
  </div>
</section>