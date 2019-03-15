<?php  $productCollection = $obj->get('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory')->create(); 
       $productModel = $obj->get('Magento\Catalog\Model\ProductRepository');
       $data = $productCollection->addAttributeToSelect('*')->addAttributeToFilter('vendor_id',1)->addAttributeToFilter('visibility',4);
?>
<section class="content">
<div class="row">
<div class="col-xs-12">
<div class="box">
                <div class="box-header">
                  <h3 class="box-title">My Products</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                      <tr role="row">
                        <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  aria-sort="ascending">ID</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Name</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Sku</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" >Price</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Qty</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Type</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"  >Status</th>
                      </tr>
                    </thead>
                    <tbody> 
                    <?php foreach($data as $data) { 
                       $product = $productModel->get($data->getSku());
                        ?>
                      <tr role="row" class="odd">
                        <td class="sorting_1"><?php echo  $product->getId(); ?></td>
                        <td><?php echo  $product->getName(); ?></td>
                        <td><?php echo  $product->getSku(); ?></td>
                        <td><?php echo  $product->getPrice(); ?></td>
                        <td><?php echo  $product->getExtensionAttributes()->getStockItem()->getQty(); ?></td>
                        <td><?php echo  $product->getTypeId(); ?></td>
                        <td><?php if($product->getStatus() == 1){ echo "Enable"; } else { echo "Disable"; } ?></td>
                      </tr>
                    <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr><th rowspan="1" colspan="1">ID</th><th rowspan="1" colspan="1">Name</th><th rowspan="1" colspan="1">Sku</th><th rowspan="1" colspan="1">Price</th><th rowspan="1" colspan="1">Qty</th><th rowspan="1" colspan="1">Type</th><th rowspan="1" colspan="1">Status</th></tr>
                    </tfoot>
                </div><!-- /.box-body -->
              </div>
</div>
</div>
</section>
        