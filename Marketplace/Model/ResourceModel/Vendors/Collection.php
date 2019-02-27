<?php

namespace Magentomaster\Marketplace\Model\ResourceModel\Vendors;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magentomaster\Marketplace\Model\Vendors', 'Magentomaster\Marketplace\Model\ResourceModel\Vendors');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>