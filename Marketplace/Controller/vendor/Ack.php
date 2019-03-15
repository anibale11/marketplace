<?php

namespace Magentomaster\Marketplace\Controller\Vendor;

use Magentomaster\Marketplace\Model\TransactionsFactory;
use Magento\Framework\Controller\ResultFactory;

class Ack extends \Magento\Framework\App\Action\Action
{
    protected $transaction;
    protected $resultRedirectFactory;

    public function __construct(TransactionsFactory $transaction,ResultFactory $resultRedirectFactory,\Magento\Framework\App\Action\Context $context)
    {
        $this->transaction = $transaction;
        $this->resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
        
    }
    public function execute()
    {
        $data = $this->getRequest()->getParams();
        //echo "<pre>"; print_r($data); die();
        if(!empty($data)){
            $records = $this->transaction->create()->load($data['ltid']);
            if(!empty($records->getData()) && $records->getTransactionId() == $data['tid'] && $records->getSellerId() == $data['si']){
                echo "i am in ";
                $records->setVendorAck(1)->save();
                return $this->resultRedirectFactory->create()->setUrl('http://localhost/magento23/seller/index.php?content=transactions');
            }
        }
    }
}