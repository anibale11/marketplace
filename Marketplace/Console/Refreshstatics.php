<?php
namespace Magentomaster\Marketplace\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Magentomaster\Marketplace\Model\OrderitemsFactory;
use Magentomaster\Marketplace\Model\VendordetailsFactory;
use Magentomaster\Marketplace\Model\Vendordetails;

class Refreshstatics extends Command
{
        protected $vendorsolditems;
        protected $vendordetails;
        protected $vendorsetdetails;

   public function __construct(OrderitemsFactory $vendorsolditems, VendordetailsFactory $vendordetails,Vendordetails $vendorsetdetails){
       parent::__construct();
       $this->vendorsolditems = $vendorsolditems;
       $this->vendordetails = $vendordetails;
       $this->vendorsetdetails = $vendorsetdetails;
   }
   protected function configure()
   {
       $this->setName('marketplace:refreshstatics');
       $this->setDescription('Refresh Vendor sales');
       parent::configure();
   }
   protected function execute(InputInterface $input, OutputInterface $output)
   {
       
        $this->doUpdate(1,'pending');
        $this->doUpdate(1,'processing');
        $this->doUpdate(1,'complete');
        $this->doUpdate(1,'closed');
        $this->finalUpdate(1);
       
   }
  
   protected function doUpdate($seller_id,$orderstatus){
        $collection = $this->vendorsolditems->create()->getCollection();
        $collection = $collection->addFieldToFilter('seller_id',$seller_id)->addFieldToFilter('order_status',$orderstatus)->getData();
        
        //sum of required parameters 
        $amount = array_sum(array_map(function($collection) { 
            return $collection['amount']; 
        }, $collection));
        $com = array_sum(array_map(function($collection) { 
            return $collection['commision']; 
            }, $collection));
        $tdr = array_sum(array_map(function($collection) { 
                return $collection['tdr']; 
                }, $collection));
        $ship = array_sum(array_map(function($collection) { 
                    return $collection['shipment_amount']; 
                    }, $collection));
        //ends here
        //insert and update data of seller
        $vendordata = $this->vendordetails->create()->getCollection()->addFieldToFilter('seller_id',$seller_id);
        if(empty($vendordata->getData())){
            if($orderstatus == 'processing'){
                $orderstatus = 'invoice';
            }
            if($orderstatus == 'complete'){
                $orderstatus = 'ship';
            }
            if($orderstatus == 'closed'){
                $orderstatus = 'creditmemo';
            }
            $status = 'total_'.$orderstatus;
            $this->vendorsetdetails->setSellerId($seller_id)
                                    ->setData($status,$amount)
                                    ->setTotalTdr($tdr)
                                    ->setTotalShipCharges($ship)
                                    ->setTotalCommission($com)
                                    ->save();
        }
        else{
            $data = $this->vendorsetdetails->load($vendordata->getData()[0]['id']);
            if($orderstatus == 'processing'){
                $orderstatus = 'invoice';
            }
            if($orderstatus == 'complete'){
                $orderstatus = 'ship';
            }
            if($orderstatus == 'closed'){
                $orderstatus = 'creditmemo';
            }
            $status = 'total_'.$orderstatus;
            $data->setData($status,$amount)->setTotalTdr($tdr)->setTotalCommission($com)->setTotalShipCharges($ship)->save();
        }

        //print data
        echo "Following Details are for seller_id 1 and for order status ".$orderstatus."\n";
        echo "Total Amount = ".$amount."\n"."Total Commission = ".$com."\n"."Total tdr = ".$tdr."\n"."Total Shipment = ".$ship."\n";
   }
    protected function finalUpdate($seller_id){

        $collection = $this->vendorsolditems->create()->getCollection();
        $collection = $collection->addFieldToFilter('seller_id',$seller_id)
                                 ->addFieldToFilter('order_status', array('neq' => 'closed'))
                                 ->addFieldToFilter('order_status', array('neq' => 'canceled'))
                                 ->getData();
        //sum of required parameters 
        $amount = array_sum(array_map(function($collection) { 
            return $collection['amount']; 
        }, $collection));
        $com = array_sum(array_map(function($collection) { 
            return $collection['commision']; 
            }, $collection));
        $tdr = array_sum(array_map(function($collection) { 
                return $collection['tdr']; 
                }, $collection));
        $ship = array_sum(array_map(function($collection) { 
                    return $collection['shipment_amount']; 
                    }, $collection));
        //ends here
        //insert and update data of seller
        $vendordata = $this->vendordetails->create()->getCollection()->addFieldToFilter('seller_id',$seller_id);
        if(empty($vendordata->getData())){
            $this->vendorsetdetails->setSellerId($seller_id)
                                    ->setTotalTdr($tdr)
                                    ->setTotalRemaining($amount)
                                    ->setTotalShipCharges($ship)
                                    ->setTotalCommission($com)
                                    ->save();
        }
        else{
            $data = $this->vendorsetdetails->load($vendordata->getData()[0]['id']);
            $data->setTotalTdr($tdr)->setTotalCommission($com)->setTotalShipCharges($ship)->setTotalRemaining($amount)->save();
        }
    }
}