<?php
namespace Magentomaster\Marketplace\Block\Adminhtml\Vendordetails;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Magentomaster\Marketplace\Model\vendordetailsFactory
     */
    protected $_vendordetailsFactory;

    /**
     * @var \Magentomaster\Marketplace\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magentomaster\Marketplace\Model\vendordetailsFactory $vendordetailsFactory
     * @param \Magentomaster\Marketplace\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magentomaster\Marketplace\Model\VendordetailsFactory $VendordetailsFactory,
        \Magentomaster\Marketplace\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_vendordetailsFactory = $VendordetailsFactory;
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
        $collection = $this->_vendordetailsFactory->create()->getCollection();
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
					'seller_id',
					[
						'header' => __('Seller Id'),
						'index' => 'seller_id',
					]
				);
				
				$this->addColumn(
					'total_pending',
					[
						'header' => __('Total Pending '),
						'index' => 'total_pending',
					]
				);
				
				$this->addColumn(
					'total_invoice',
					[
						'header' => __('Total Invoice'),
						'index' => 'total_invoice',
					]
				);
				
				$this->addColumn(
					'total_ship',
					[
						'header' => __('Total Ship'),
						'index' => 'total_ship',
					]
				);
				
				$this->addColumn(
					'total_creditmemo',
					[
						'header' => __('Total Refund'),
						'index' => 'total_creditmemo',
					]
				);
				
				$this->addColumn(
					'total_paid',
					[
						'header' => __('Total Paid'),
						'index' => 'total_paid',
					]
				);
				
				$this->addColumn(
					'total_remaining',
					[
						'header' => __('Total Remaining'),
						'index' => 'total_remaining',
					]
				);
				
				$this->addColumn(
					'total_tdr',
					[
						'header' => __('Total TDR'),
						'index' => 'total_tdr',
					]
				);
				
				$this->addColumn(
					'total_commission',
					[
						'header' => __('Total Commission'),
						'index' => 'total_commission',
					]
				);
				


		

		
		   $this->addExportType($this->getUrl('marketplace/*/exportCsv', ['_current' => true]),__('CSV'));
		   $this->addExportType($this->getUrl('marketplace/*/exportExcel', ['_current' => true]),__('Excel XML'));

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
        //$this->getMassactionBlock()->setTemplate('Magentomaster_Marketplace::vendordetails/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('vendordetails');

        $this->getMassactionBlock()->addItem(
            'delete',
            [
                'label' => __('Delete'),
                'url' => $this->getUrl('marketplace/*/massDelete'),
                'confirm' => __('Are you sure?')
            ]
        );

        $statuses = $this->_status->getOptionArray();

        $this->getMassactionBlock()->addItem(
            'status',
            [
                'label' => __('Change status'),
                'url' => $this->getUrl('marketplace/*/massStatus', ['_current' => true]),
                'additional' => [
                    'visibility' => [
                        'name' => 'status',
                        'type' => 'select',
                        'class' => 'required-entry',
                        'label' => __('Status'),
                        'values' => $statuses
                    ]
                ]
            ]
        );


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
     * @param \Magentomaster\Marketplace\Model\vendordetails|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		return '#';
    }

	

}