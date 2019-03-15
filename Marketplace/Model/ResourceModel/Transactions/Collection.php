<?php

namespace Magentomaster\Marketplace\Model\ResourceModel\Transactions;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magentomaster\Marketplace\Model\Transactions', 'Magentomaster\Marketplace\Model\ResourceModel\Transactions');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }

}
?>