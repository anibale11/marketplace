<?php
namespace Magentomaster\Marketplace\Block\Adminhtml\Orderitems;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Magentomaster\Marketplace\Model\orderitemsFactory
     */
    protected $_orderitemsFactory;

    /**
     * @var \Magentomaster\Marketplace\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magentomaster\Marketplace\Model\orderitemsFactory $orderitemsFactory
     * @param \Magentomaster\Marketplace\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magentomaster\Marketplace\Model\OrderitemsFactory $OrderitemsFactory,
        \Magentomaster\Marketplace\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_orderitemsFactory = $OrderitemsFactory;
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
        $this->setSaveParametersInSession(false);
        $this->setUseAjax(true);
        $this->setVarNameFilter('post_filter');
    }

    /**
     * @return $this
     */
    protected function _prepareCollection()
    {
        $collection = $this->_orderitemsFactory->create()->getCollection();
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
					'sku',
					[
						'header' => __('Product Sku'),
						'index' => 'sku',
					]
                );
                
                $this->addColumn(
					'order_id',
					[
						'header' => __('Order ID'),
						'index' => 'order_id',
					]
                );
                
				$this->addColumn(
					'seller_id',
					[
						'header' => __('Seller ID'),
						'index' => 'seller_id',
					]
                );
                
				$this->addColumn(
					'amount',
					[
						'header' => __('Product Amount '),
                        'index' => 'amount',
                        'type' => 'decimal',
					]
				);
                
                $this->addColumn(
					'qty',
					[
						'header' => __('Buy Qty'),
						'index' => 'qty',
					]
				);
				
				$this->addColumn(
					'commision',
					[
						'header' => __('Commission'),
                        'index' => 'commision',
                        'type' => 'decimal',
					]
                );
                
                $this->addColumn(
					'tdr',
					[
						'header' => __('TDR'),
                        'index' => 'tdr',
                        'type' => 'decimal',
					]
                );

                $this->addColumn(
					'shipment_amount',
					[
						'header' => __('Shipment Amount'),
                        'index' => 'shipment_amount',
                        'type' => 'decimal',
					]
				);
				
				$this->addColumn(
					'order_status',
					[
						'header' => __('Order Status'),
						'index' => 'order_status',
					]
                );
                
				$this->addColumn(
					'order_date',
					[
						'header' => __('Order Date'),
                        'index' => 'order_date',
                        'type' => 'datetime',
					]
				);
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
        //$this->getMassactionBlock()->setTemplate('Magentomaster_Marketplace::orderitems/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('orderitems');

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
     * @param \Magentomaster\Marketplace\Model\orderitems|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		return '#';
    }

	

}