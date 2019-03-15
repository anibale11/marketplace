<?php

namespace Magentomaster\Marketplace\Controller\Index;

use Magento\Framework\Controller\ResultFactory;
use Magentomaster\Marketplace\Helper\Sender;
use Magento\Framework\App\Filesystem\DirectoryList;

class Update extends \Magento\Framework\App\Action\Action
{
    protected $vendorModel;
    protected $resultRedirectFactory;
    protected $sender;
    protected $uploader;
    protected $filesystem;

    public function __construct(\Magento\Framework\App\Action\Context $context,
                                \Magentomaster\Marketplace\Model\VendorsFactory $vendorModel,
                                \Magento\Framework\Message\ManagerInterface $messageManager,
                                ResultFactory $resultRedirectFactory,
                                \Magento\Framework\Filesystem $filesystem,
                                \Magento\MediaStorage\Model\File\UploaderFactory $uploader,
                                Sender $sender
                                )
    {
      $this->vendorModel = $vendorModel;
      $this->resultRedirectFactory = $resultRedirectFactory;
      $this->sender = $sender;
      $this->_filesystem = $filesystem;
      $this->_fileUploaderFactory = $uploader;
      parent::__construct($context);
    }
    public function execute()
    {
      $post1 = $this->getRequest()->getPostValue();
      if(!empty($post1)){
        foreach($_FILES as $key=>$value){
          if($value['name']){
            $uploader = $this->_fileUploaderFactory->create(['fileId' => $key]);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(false);
            $path = $this->_filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath('seller/');
            $result = $uploader->save($path);
            $post1[$key]=$result['file'];
          }
        }
        if(isset($post1['email'])){
          $result = $this->vendorModel->create()->getCollection()->addFieldToFilter('email',$post1['email']);
         if(!empty($result->getData())){
          $this->vendorModel->create()->load(1)->setData($post1)->setId(1)->save();
         }
       }
      }
      return $this->resultRedirectFactory->create()->setUrl('http://localhost/magento23/seller/index.php?content=profile');
    }
}