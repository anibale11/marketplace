<?php
namespace Magentomaster\Marketplace\Observer;

use Magento\Sales\Model\Order;
use Magento\Catalog\Model\Product;
use Magentomaster\Marketplace\Model\Orderitems;

class Savesellerorder implements \Magento\Framework\Event\ObserverInterface
{
  protected $ordermodel;
  protected $productmodel;
  protected $vendororderitem;

  public function __construct(
                              Order $ordermodel,
                              Product $productmodel,
                              Orderitems $vendororderitem
                              ) 
  {
    $this->orderModel = $ordermodel;
    $this->productmodel = $productmodel;
    $this->vendororderitem = $vendororderitem;
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
      $productSku = $item->getSku();
      $productPrice = $item->getPrice();
      $baseProductPrice = $item->getBasePrice ();
      $productQty = $item->getQtyOrdered ();
      //load product model
      $product = $this->productmodel->load($productId);
      $sellerId = $product->getSellerId();
      //end here
      if($sellerId){
      $this->vendororderitem->setSku($productSku)
                             ->setAmount()
                             ->setCommission()
                             ->setTdr()
                             ->setQty($productQty)
                             ->setOrderId($orderid)
                             ->setSellerId($sellerId)
                             ->setOrderStatus($status)
                             ->setShipmentAmount($orderShippingAmount)
                             ->setOrderDate($createdAt);
      }
    }
    //iteration end here 
    return $this;
  }
    private function getCommision(){

    }
    private function getTdr(){

    }
    private function getAmount(){

    }
    private function sendMail(){
        
    }
}