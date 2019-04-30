<?php

namespace Magentomaster\Marketplace\Controller\Vendor;

use Magento\Framework\Controller\ResultFactory;

class Logout extends \Magento\Framework\App\Action\Action
{
    protected $resultRedirectFactory;

    public function __construct(ResultFactory $resultRedirectFactory,\Magento\Framework\App\Action\Context $context)
    {
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
        
    }
    public function execute()
    {
        session_destroy();
        return $this->resultRedirectFactory->create()->setPath('seller/login.php');
    }
}