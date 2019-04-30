<?php

namespace Magentomaster\Marketplace\Block\Adminhtml;

class Transactions extends \Magento\Backend\Block\Widget\Container
{
    /**
     * @var string
     */
    protected $_template = 'transactions/transactions.phtml';

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(\Magento\Backend\Block\Widget\Context $context,array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Prepare button and grid
     *
     * @return \Magento\Catalog\Block\Adminhtml\Product
     */
    protected function _prepareLayout()
    {
        $this->addButton(
            'preview_product',
            $this->getButtonData()
        );
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock('Magentomaster\Marketplace\Block\Adminhtml\Transactions\Grid', 'magentomaster.transactions.grid')
        );
        return parent::_prepareLayout();
    }

    /**
     *
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Add New'),
            'on_click' => sprintf("window.open('%s')", $this->_getCreateUrl()),
            'class' => 'action-default primary add',
            'sort_order' => 20
        ];
    }

    /**
     *
     *
     * @param string $type
     * @return string
     */
    protected function _getCreateUrl()
    {
        return $this->getUrl(
            'marketplace/*/new'
        );
    }

    /**
     * Render grid
     *
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }

}