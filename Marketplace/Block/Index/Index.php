<?php

namespace Magentomaster\Marketplace\Block\Index;


class Index extends \Magento\Framework\View\Element\Template {

    protected $_country;

    public function __construct(\Magento\Catalog\Block\Product\Context $context, \Magento\Directory\Model\Config\Source\Country $_country, array $data = []) {
        
        $this->_country = $_country;
        parent::__construct($context, $data);

    }

    public function getCountries(){
        $countries = $this->_country->toOptionArray(true, 'IN');
        return $countries;
    }
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }

}