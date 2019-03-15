<?php  $orderCollection = $obj->get('Magentomaster\Marketplace\Model\TransactionsFactory')->create()->getCollection(); 
       $data = $orderCollection->addFieldToFilter('seller_id',1);
       //echo "<pre>"; print_r($data->getData()); die('dead');
?>
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
                <div class="box-header">
                  <h3 class="box-title">Transactions Details</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending">ID</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Transaction ID</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Transaction Date</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Amount</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Transaction Status</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Acknowledgment</th>
                      </tr>
                    </thead>
                    <tbody> 
                    <?php foreach($data as $data) { 
                  
                     // echo "<pre>"; print_r($order->getData());
                        ?>
                      <tr role="row" class="odd">
                        <td class="sorting_1"><?php echo  $data->getId(); ?></td>
                        <td><?php echo  $data->getTransactionId(); ?></td>
                        <td><?php echo  $data->getTransactionDate() ?></td>
                        <td><?php echo  $data->getAmount() ?></td>
                        <td><?php if($data->getStatus()==0){ echo "Paid"; } else { echo "Unpaid"; } ?></td>
                        <td><?php  if(!$data->getVendorAck()){?> <a href="http://localhost/magento23/marketplace/vendor/ack">Acknowledge Payment</a> <?php } else {echo "Acknowledged";}?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th rowspan="1" colspan="1">ID</th>
                        <th rowspan="1" colspan="1">Transaction ID</th>
                        <th rowspan="1" colspan="1">Transaction Date</th>
                        <th rowspan="1" colspan="1">Amount</th>
                        <th rowspan="1" colspan="1">Transaction Status</th>
                        <th rowspan="1" colspan="1">Acknowledgment</th>
                     </tr>
                    </tfoot>
                </div><!-- /.box-body -->
              </div>
</div>
</div>
</section>