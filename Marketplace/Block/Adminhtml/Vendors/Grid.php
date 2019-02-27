<?php
namespace Magentomaster\Marketplace\Block\Adminhtml\Vendors;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Magentomaster\Marketplace\Model\vendorsFactory
     */
    protected $_vendorsFactory;

    /**
     * @var \Magentomaster\Marketplace\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magentomaster\Marketplace\Model\vendorsFactory $vendorsFactory
     * @param \Magentomaster\Marketplace\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magentomaster\Marketplace\Model\VendorsFactory $VendorsFactory,
        \Magentomaster\Marketplace\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_vendorsFactory = $VendorsFactory;
        $this->_status = $status;
        $this->moduleManager = $moduleManager;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setId('postGrid');
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(false);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_vendorsFactory->create()->getCollection();
        $this->setCollection($collection);

        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return $this
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('ID'),
                'type' => 'number',
                'index' => 'id',
                'header_css_class' => 'col-id',
                'column_css_class' => 'col-id'
            ]
        );


		
				$this->addColumn(
					'name',
					[
						'header' => __('Name '),
						'index' => 'name',
					]
				);
				
				$this->addColumn(
					'city',
					[
						'header' => __('City'),
						'index' => 'city',
					]
                );
                $this->addColumn(
					'country',
					[
						'header' => __('Country'),
						'index' => 'country',
					]
				);
                $this->addColumn(
					'email',
					[
						'header' => __('Email'),
						'index' => 'email',
					]
                );
                $this->addColumn(
					'phoneno',
					[
						'header' => __('Phone No'),
						'index' => 'phoneno',
					]
				);
				$this->addColumn(
					'pincode',
					[
						'header' => __('Pincode'),
						'index' => 'pincode',
					]
				);
				
				$this->addColumn(
					'gst_no',
					[
						'header' => __('GST No'),
						'index' => 'gst_no',
					]
				);
				
				$this->addColumn(
					'status',
					[
						'header' => __('Status'),
						'index' => 'status',
					]
				);
				
				$this->addColumn(
					'comission',
					[
						'header' => __('Vendor Commission'),
						'index' => 'comission',
					]
				);
				
				$this->addColumn(
					'shop_url',
					[
						'header' => __('Shop Url'),
						'index' => 'shop_url',
					]
				);
				
				$this->addColumn(
					'store_name',
					[
						'header' => __('Store Name'),
						'index' => 'store_name',
					]
				);
				


		
        //$this->addColumn(
            //'edit',
            //[
                //'header' => __('Edit'),
                //'type' => 'action',
                //'getter' => 'getId',
                //'actions' => [
                    //[
                        //'caption' => __('Edit'),
                        //'url' => [
                            //'base' => '*/*/edit'
                        //],
                        //'field' => 'id'
                    //]
                //],
                //'filter' => false,
                //'sortable' => false,
                //'index' => 'stores',
                //'header_css_class' => 'col-action',
                //'column_css_class' => 'col-action'
            //]
        //);
		

		
		   $this->addExportType($this->getUrl('marketplace/*/exportCsv', ['_current' => true]),__('CSV'));

        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }

        return parent::_prepareColumns();
    }

	
    /**
     * @return $this
     */
    protected function _prepareMassaction()
    {

        $this->setMassactionIdField('id');
        //$this->getMassactionBlock()->setTemplate('Magentomaster_Marketplace::vendors/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('vendors');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('marketplace/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();
        return $this;
    }
		

    /**
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('marketplace/*/index', ['_current' => true]);
    }

    /**
     * @param \Magentomaster\Marketplace\Model\vendors|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'marketplace/*/edit',
            ['id' => $row->getId()]
        );
		
    }

	

}