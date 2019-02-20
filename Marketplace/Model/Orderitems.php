<?php
namespace Magentomaster\Marketplace\Model;

class Orderitems extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magentomaster\Marketplace\Model\ResourceModel\Orderitems');
    }
}
?>