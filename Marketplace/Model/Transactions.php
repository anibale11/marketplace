<?php
namespace Magentomaster\Marketplace\Model;

class Transactions extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magentomaster\Marketplace\Model\ResourceModel\Transactions');
    }
}
?>