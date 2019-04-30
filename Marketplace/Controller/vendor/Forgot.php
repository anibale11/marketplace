<?php

namespace Magentomaster\Marketplace\Controller\Vendor;

use Magentomaster\Marketplace\Model\VendorsFactory;
use Magento\Framework\Controller\ResultFactory;
use Magentomaster\Marketplace\Helper\Sender;

class Forgot extends \Magento\Framework\App\Action\Action
{
    protected $vendor;
    protected $resultRedirectFactory;
    protected $sender;

    public function __construct(VendorsFactory $vendor, Sender $sender, ResultFactory $resultRedirectFactory,\Magento\Framework\App\Action\Context $context)
    {
        $this->vendor = $vendor;
        $this->resultRedirectFactory = $resultRedirectFactory;
        $this->sender = $sender;
        parent::__construct($context);
        
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        // echo "<pre>"; print_r($data); die;
        if(!empty($data)){
            $records = $this->vendor->create()->getCollection()->addFieldToFilter('email',$data['email']);
            if(!empty($records->getData()[0])){
                $email = $records->getData()[0]['email'];
                $msg ="Please reset password by clicking on this link";
                $this->sender->sendGeneralMessage($data,$email,$msg);
                return $this->resultRedirectFactory->create()->setUrl('http://localhost/magento23/seller/forgot.php?msg=0');
            }
            else{
                return $this->resultRedirectFactory->create()->setUrl('http://localhost/magento23/seller/forgot.php?msg=1');
            }
        }
    }
}