<?php
namespace Magentomaster\Restrictcod\Observer;
use \Magentomaster\Pincode\Model\PincodeFactory as ShiprocketPincode;

class Restrictcod implements \Magento\Framework\Event\ObserverInterface
{
  protected $pincodecollection;

  public function __construct(
    ShiprocketPincode $pincodecollection
  ) {
      $this->pincodecollection = $pincodecollection;
  }
  
  public function execute(\Magento\Framework\Event\Observer $observer)
  {
    $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    $postcode = $objectManager->get('\Magento\Checkout\Model\Cart')->getQuote()->getShippingAddress()->getPostcode();
    $collection = $this->pincodecollection->create()->getCollection()->addFieldToFilter('pincode',$postcode);
    $flag = 0;
    foreach($collection as $pincode){
      if(!$flag){
        $flag = $pincode->getCod();
      }
    }

    if($observer->getEvent()->getMethodInstance()->getCode()=="cashondelivery" && !$flag){
       $checkResult = $observer->getEvent()->getResult();
       $checkResult->setData('is_available', false);
     }
     
    return $this;
  }
}