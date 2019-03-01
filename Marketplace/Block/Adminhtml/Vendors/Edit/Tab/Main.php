<?php

namespace Magentomaster\Marketplace\Block\Adminhtml\Vendors\Edit\Tab;

/**
 * Vendors edit form main tab
 */
class Main extends \Magento\Backend\Block\Widget\Form\Generic implements \Magento\Backend\Block\Widget\Tab\TabInterface
{
    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;

    /**
     * @var \Magentomaster\Marketplace\Model\Status
     */
    protected $_status;
    /**
     * @var \Magento\Directory\Model\Config\Source\Country
     */
    protected $_country;

    /**
     * @var \Magento\Directory\Model\RegionFactory
     */
    protected $_regionFactory;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Store\Model\System\Store $systemStore,
        \Magentomaster\Marketplace\Model\Status $status,
        \Magento\Directory\Model\Config\Source\Country $_country,
        \Magento\Directory\Model\RegionFactory $_regionFactory,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_status = $status;
        $this->_country = $_country;
        $this->_regionFactory = $_regionFactory;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Prepare form
     *
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareForm()
    {
        /* @var $model \Magentomaster\Marketplace\Model\BlogPosts */
        $model = $this->_coreRegistry->registry('vendors');

        $isElementDisabled = false;

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create();

        $form->setHtmlIdPrefix('page_');

        $fieldset = $form->addFieldset('base_fieldset', ['legend' => __('Item Information')]);

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
        
        //added code for country and region
        $countries = $this->_country->toOptionArray(true, 'IN');
        $regionCollection = $this->_regionFactory->create()->getCollection()->addCountryFilter('IN');
        //added code end here
		
        $fieldset->addField(
            'name',
            'text',
            [
                'name' => 'name',
                'label' => __('Name '),
                'title' => __('Name '),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'street_address',
            'textarea',
            [
                'name' => 'street_address',
                'label' => __('Street Address'),
                'title' => __('Street Address'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'city',
            'text',
            [
                'name' => 'city',
                'label' => __('City'),
                'title' => __('City'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );

        $fieldset->addField(
            'country',
            'select',
            [
                'name' => 'country',
                'label' => __('Country'),
                'title' => __('Country'),
                'required' => true,
                'values' => $countries,
                'disabled' => $isElementDisabled
            ]
        );
        $fieldset->addField(
            'email',
            'text',
            [
                'name' => 'email',
                'label' => __('Email'),
                'title' => __('Email'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
		$fieldset->addField(
            'phoneno',
            'text',
            [
                'name' => 'phoneno',
                'label' => __('Phone no'),
                'title' => __('Phone no'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'pincode',
            'text',
            [
                'name' => 'pincode',
                'label' => __('Pincode'),
                'title' => __('Pincode'),
				'required' => true,
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'gst_no',
            'text',
            [
                'name' => 'gst_no',
                'label' => __('GST No'),
                'title' => __('GST No'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'comission',
            'text',
            [
                'name' => 'comission',
                'label' => __('Vendor Commission'),
                'title' => __('Vendor Commission'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'shop_url',
            'text',
            [
                'name' => 'shop_url',
                'label' => __('Shop Url'),
                'title' => __('Shop Url'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'bank_details',
            'textarea',
            [
                'name' => 'bank_details',
                'label' => __('Bank details'),
                'title' => __('Bank details'),
				
                'disabled' => $isElementDisabled
            ]
        );
					
        $fieldset->addField(
            'store_name',
            'text',
            [
                'name' => 'store_name',
                'label' => __('Store Name'),
                'title' => __('Store Name'),
				
                'disabled' => $isElementDisabled
            ]
        );
            
        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'title' => __('Status'),
				'values' => array('Disable','Enable'),
                'disabled' => $isElementDisabled
            ]
        );

        if (!$model->getId()) {
            $model->setData('is_active', $isElementDisabled ? '0' : '1');
        }

        $form->setValues($model->getData());
        $this->setForm($form);
		
        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Item Information');
    }

    /**
     * Prepare title for tab
     *
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Item Information');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
    
    public function getTargetOptionArray(){
    	return array(
    				'_self' => "Self",
					'_blank' => "New Page",
    				);
    }
}
