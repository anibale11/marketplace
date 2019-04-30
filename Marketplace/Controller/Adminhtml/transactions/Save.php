<?php
namespace Magentomaster\Marketplace\Controller\Adminhtml\transactions;

use Magento\Backend\App\Action;
use Magentomaster\Marketplace\Model\VendordetailsFactory;
use Magento\Framework\App\Filesystem\DirectoryList;


class Save extends \Magento\Backend\App\Action
{

    /**
     * @param Action\Context $context
     */
    protected $vendordetails;

    public function __construct(VendordetailsFactory $vendordetails, Action\Context $context)
    {
        $this->vendorDetails = $vendordetails;
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
        $vendordetails = $this->vendorDetails->create()->getCollection()->addFieldToFilter('seller_id',$data['seller_id']);
        foreach($vendordetails as $vendordetails){
            $alreadypaid = $vendordetails->getTotalPaid();
            $totalpaid = $alreadypaid + $data['amount'];
            $totaLremaining = ($vendordetails->getTotalRemaining()) - ($data['amount']);
            $this->vendorDetails->create()->load($vendordetails->getId())->setTotalPaid($totalpaid)->setTotalRemaining($totaLremaining)->save();
        }
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($data) {
            $model = $this->_objectManager->create('Magentomaster\Marketplace\Model\Transactions');

            $id = $this->getRequest()->getParam('id');
            if ($id) {
                $model->load($id);
                $model->setCreatedAt(date('Y-m-d H:i:s'));
            }
			
			
            $model->setData($data);

            try {
                $model->save();
                $this->messageManager->addSuccess(__('The Transactions has been saved.'));
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
                $this->messageManager->addException($e, __('Something went wrong while saving the Transactions.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}