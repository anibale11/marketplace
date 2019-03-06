<?php
namespace Magentomaster\Marketplace\Observer;

use Magento\Sales\Model\Order;
use Magento\Catalog\Model\Product;
use Magentomaster\Marketplace\Model\OrderitemsFactory;
use Magentomaster\Marketplace\Model\Orderitems;
use Magentomaster\Marketplace\Helper\Data;
use Magentomaster\Marketplace\Helper\Sender;

class Updatesellerorder implements \Magento\Framework\Event\ObserverInterface
{
  protected $ordermodel;
  protected $productmodel;
  protected $vendororderitem;
  protected $vendororderiteminsert;
  protected $helper;
  protected $sender;

  public function __construct(
                              Order $ordermodel,
                              Product $productmodel,
                              OrderitemsFactory $vendororderitem,
                              Data $helper,
                              Orderitems $vendororderiteminsert,
                              Sender $sender
                              ) 
  {
    $this->orderModel = $ordermodel;
    $this->productmodel = $productmodel;
    $this->vendororderitem = $vendororderitem;
    $this->helper = $helper;
    $this->vendororderiteminsert = $vendororderiteminsert;
    $this->sender = $sender;
  }

  public function execute(\Magento\Framework\Event\Observer $observer)
  {
     $invoice = $observer->getEvent()->getInvoice();
     $orderid = $invoice->getOrder()->getId();
     $orderdata = $this->orderModel->load($orderid);
     //Fetch required data from order object
     $status= $orderdata->getStatus();
     $currencyCode = $orderdata->getOrderCurrencyCode();
     $orderShippingAmount = $orderdata->getShippingAmount();
     $createdAt=$orderdata->getCreatedAt();
     $orderItems = $orderdata->getAllItems();
     //fetch data end here from order model
 
     // 
     foreach ($orderItems as $item) {
       $productId = $item->getProductId();
       $productPriceTaxIncluded = $item->getRowTotalInclTax();
       $qty = $item->getQtyOrdered();
       //load product model
       $product = $this->productmodel->load($productId);
       $sku = $product->getSku();
       $sellerId = $product->getVendorId();
       $sellerEmail = $product->getSellerEmailId();
       $data = $this->vendororderitem->create()->getCollection()
                             ->addFieldToFilter('order_id',$orderid)
                             ->addFieldToFilter('seller_id',$sellerId)
                             ->addFieldToFilter('sku',$sku);
                           
       //end here
       if($sellerId && !empty($data->getData())){
        try{
        $data = $this->vendororderiteminsert->load($data->getData()[0]['id']);
        
        $data->setAmount($item->getRowTotalInclTax())
                              ->setQty($qty)
                              ->setOrderStatus('processing')
                              ->setShipmentAmount($orderShippingAmount)
                              ->setOrderDate($createdAt)
                              ->save();
        //send email
        $message = "Invoice has been created for order ".$orderid." and for item sku ".$sku;
        $this->sender->sendOrderEmail($orderdata,$sellerEmail,$message);
        }
        catch(Exception $e){
         echo $e->getMessage();
        }
       }
     }
     //iteration end here 
     return $this;
  }
}