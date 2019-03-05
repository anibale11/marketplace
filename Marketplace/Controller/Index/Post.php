<?php

namespace Magentomaster\Marketplace\Controller\Index;

use Magentomaster\Marketplace\Model\VendorsFactory;
use Magento\Framework\Controller\ResultFactory;
use Magentomaster\Marketplace\Helper\Sender;

class Post extends \Magento\Framework\App\Action\Action
{
    protected $vendorModel;
    protected $_messageManager;
    protected $resultRedirectFactory;
    protected $sender;

    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magentomaster\Marketplace\Model\VendorsFactory $vendorModel,
                                \Magento\Framework\Message\ManagerInterface $messageManager,
                                ResultFactory $resultRedirectFactory,
                                Sender $sender
                                )
    {
      $this->vendorModel = $vendorModel;
      $this->_messageManager = $messageManager;
      $this->resultRedirectFactory = $resultRedirectFactory;
      $this->sender = $sender;
      parent::__construct($context);
    }
    public function execute()
    {
      $post1 = $this->getRequest()->getPostValue();
      try{
        if(!empty($post1)){
          $this->vendorModel->create()->setData($post1)->save();
          $this->sender->sendTransactionalEmail($post1);
          //$this->sender->sendOrderEmail($post1,'kushaljindal92@gmail.com'); //test mail function
          $this->_messageManager->addSuccess(__("Your request has been submitted. You will be contacted by our executive soon."));
        }
      }
      catch(Exception $e){
        throw new \Exception($e->getMessage());
        $this->_messageManager->addError(__($e->getMessage()));
      }
      return $this->resultRedirectFactory->create()->setPath('marketplace/index/index');
    }
}