<?php

namespace Magentomaster\Marketplace\Block\Vendor;

use Magentomaster\Marketplace\Model\VendorsFactory;
use Magento\Catalog\Model\ProductFactory;

class Index extends \Magento\Framework\View\Element\Template {
    public function __construct(\Magento\Catalog\Block\Product\Context $context, VendorsFactory $vendor,ProductFactory $product, array $data = []) {
        $this->vendor = $vendor;
        $this->product = $product;
        parent::__construct($context, $data);
    }
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
    public function getVendor(){
        $id = $this->getRequest()->getParam('id');
        if(isset($id)){
         $data = $this->vendor->create()->load($this->getRequest()->getParam('id'));
         if(!empty($data)){
            echo "<pre>"; print_r($data->getData());
         }
       
        }
    }
    public function getProductCollection(){
        $id = $this->getRequest()->getParam('id');
        $data = $this->product->create()->getCollection()->addAttributeToFilter('*')->addFieldToFilter('vendor_id',$id)->addAttributeToFilter('visibility',4);
        if(!empty($data)){
            echo "<pre>"; print_r($data->getData());
         }
    }
}