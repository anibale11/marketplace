<?php

namespace Magentomaster\Marketplace\Controller\Vendor;

use Magentomaster\Marketplace\Model\VendorsFactory;
use Magento\Framework\Controller\ResultFactory;

class Login extends \Magento\Framework\App\Action\Action
{
    protected $vendor;
    protected $resultRedirectFactory;

    public function __construct(VendorsFactory $vendor,ResultFactory $resultRedirectFactory,\Magento\Framework\App\Action\Context $context)
    {
        $this->vendor = $vendor;
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
        
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        if(!empty($data)){
            $records = $this->vendor->create()->getCollection()->addFieldToFilter('email',$data['email'])->addFieldToFilter('password',md5($data['password']));
            if(!empty($records->getData()[0])){
               $_SESSION['email']= $data['email'];
               $_SESSION['islogined'] = 1;
               return $this->resultRedirectFactory->create()->setPath('seller/login.php');
            }
            else{
                unset($_SESSION['email']);
                unset($_SESSION['islogined']);
            }
        }
    }
}