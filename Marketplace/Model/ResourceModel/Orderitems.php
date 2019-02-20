<?php
namespace Magentomaster\Marketplace\Model\ResourceModel;

class Orderitems extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('vendor_order_items', 'id');
    }
}
?>