<?php
namespace Magentomaster\Marketplace\Observer;

use Magento\Sales\Model\Order;
use Magento\Catalog\Model\Product;
use Magentomaster\Marketplace\Model\Orderitems;
use Magentomaster\Marketplace\Helper\Data;

class Savesellerorder implements \Magento\Framework\Event\ObserverInterface
{
  protected $ordermodel;
  protected $productmodel;
  protected $vendororderitem;
  protected $helper;

  public function __construct(
                              Order $ordermodel,
                              Product $productmodel,
                              Orderitems $vendororderitem,
                              Data $helper
                              ) 
  {
    $this->orderModel = $ordermodel;
    $this->productmodel = $productmodel;
    $this->vendororderitem = $vendororderitem;
    $this->helper = $helper;
  }

  public function execute(\Magento\Framework\Event\Observer $observer)
  {
    $orderid = $observer->getOrderIds()[0];  
    $orderdata = $this->orderModel->load($orderid);
    //Fetch required data from order object
    $status= $orderdata->getStatus();
    $currencyCode = $orderdata->getOrderCurrencyCode();
    $orderShippingAmount = $orderdata->getShippingAmount();
    $createdAt=$orderdata->getCreatedAt();
    $orderItems = $orderdata->getAllItems();
    //fetch data end here from order model

    // Iterate each item and check if seller is associated and save information following 
    foreach ($orderItems as $item) {
      $productId = $item->getProductId();
      $productPriceTaxIncluded = $item->getRowTotalInclTax();
      $qty = $item->getQtyOrdered();
      //load product model
      $product = $this->productmodel->load($productId);
      $sellerId = $product->getVendorId();
      //end here
      $commissionvalue = $this->getCommision($productPriceTaxIncluded,$qty);
      $tdrvalue = $this->getTdr($commissionvalue);
      if($sellerId){
       try{
       $this->vendororderitem->setSku($item->getSku())
                             ->setAmount($item->getRowTotalInclTax())
                             ->setCommision($commissionvalue)
                             ->setTdr($tdrvalue)
                             ->setQty($qty)
                             ->setOrderId($orderid)
                             ->setSellerId($sellerId)
                             ->setOrderStatus($status)
                             ->setShipmentAmount($orderShippingAmount)
                             ->setOrderDate($createdAt)
                             ->save();
       }
       catch(Exception $e){
        echo $e->getMessage();
       }
      }
    }
    //iteration end here 
    return $this;
  }
    protected function getCommision($productPriceTaxIncluded,$qty){
      $commission = (float)$this->helper->getGeneralConfig('commission');
      $commission = ($productPriceTaxIncluded * $qty * $commission)/100;
      return $commission;
    }
    protected function getTdr($commissionvalue){
      $tdr = (float)$this->helper->getGeneralConfig('tdr');
      $tdr = ($commissionvalue *$tdr)/100;
      return $tdr; 
      
    }
    protected function getAmount(){

    }
    protected function sendMail(){
        
    }
}