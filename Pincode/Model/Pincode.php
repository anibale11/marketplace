<?php
namespace Magentomaster\Pincode\Model;

class Pincode extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magentomaster\Pincode\Model\ResourceModel\Pincode');
    }
}
?>