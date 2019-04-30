<?php
namespace Magentomaster\Marketplace\Controller\Adminhtml\vendors;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magentomaster\Marketplace\Helper\Sender;


class Save extends \Magento\Backend\App\Action
{
    protected $sender;

    /**
     * @param Action\Context $context
     */
    public function __construct(Action\Context $context, Sender $sender)
    {
        $this->sender = $sender;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        $email = $data['email'];
        $message = "";
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Magentomaster\Marketplace\Model\Vendors');

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
                $model->setCreatedAt(date('Y-m-d H:i:s'));
                //code is added here for password
                if(!$model->getPassword() && $data['status'] == 1){
                    $data['password'] = md5($data['phoneno']);
                    $password = $data['phoneno'];
                    $message = "Your account has been approved and your password for login is ".$password;
                    $this->sender->sendGeneralMessage($data,$email,$message);
                }
            }
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Vendors has been saved.'));
                $this->_objectManager->get('Magento\Backend\Model\Session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $model->getId(), '_current' => true]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the Vendors.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}