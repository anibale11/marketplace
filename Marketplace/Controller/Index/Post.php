<?php

namespace Magentomaster\Marketplace\Controller\Index;

use Magentomaster\Marketplace\Model\VendorsFactory;
use Magento\Framework\Controller\ResultFactory;

class Post extends \Magento\Framework\App\Action\Action
{
    protected $vendorModel;
    protected $_messageManager;
    protected $resultRedirectFactory;
    protected $transportBuilder;

    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magentomaster\Marketplace\Model\VendorsFactory $vendorModel,
                                \Magento\Framework\Message\ManagerInterface $messageManager,
                                ResultFactory $resultRedirectFactory,
                                \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
                                )
    {
      $this->vendorModel = $vendorModel;
      $this->_messageManager = $messageManager;
      $this->resultRedirectFactory = $resultRedirectFactory;
      $this->transportBuilder = $transportBuilder;
      parent::__construct($context);
    }
    public function execute()
    {
      $post1 = $this->getRequest()->getPostValue();
      try{
        if(!empty($post1)){
          $this->vendorModel->create()->setData($post1)->save();
          $this->sendMail($post1);
          $this->_messageManager->addSuccess(__("Your request has been submitted. You will be contacted by our executive soon."));
        }
      }
      catch(Exception $e){
        throw new \Exception($e->getMessage());
        $this->_messageManager->addError(__($e->getMessage()));
      }
      return $this->resultRedirectFactory->create()->setPath('marketplace/index/index');
    }
    protected function sendMail($data){

    }
}