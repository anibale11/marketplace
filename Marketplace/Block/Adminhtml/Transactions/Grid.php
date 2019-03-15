<?php
namespace Magentomaster\Marketplace\Block\Adminhtml\Transactions;

class Grid extends \Magento\Backend\Block\Widget\Grid\Extended
{
    /**
     * @var \Magento\Framework\Module\Manager
     */
    protected $moduleManager;

    /**
     * @var \Magentomaster\Marketplace\Model\transactionsFactory
     */
    protected $_transactionsFactory;

    /**
     * @var \Magentomaster\Marketplace\Model\Status
     */
    protected $_status;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Backend\Helper\Data $backendHelper
     * @param \Magentomaster\Marketplace\Model\transactionsFactory $transactionsFactory
     * @param \Magentomaster\Marketplace\Model\Status $status
     * @param \Magento\Framework\Module\Manager $moduleManager
     * @param array $data
     *
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Backend\Helper\Data $backendHelper,
        \Magentomaster\Marketplace\Model\TransactionsFactory $TransactionsFactory,
        \Magentomaster\Marketplace\Model\Status $status,
        \Magento\Framework\Module\Manager $moduleManager,
        array $data = []
    ) {
        $this->_transactionsFactory = $TransactionsFactory;
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
        $collection = $this->_transactionsFactory->create()->getCollection();
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
					'transaction_id',
					[
						'header' => __('Transaction ID'),
						'index' => 'transaction_id',
					]
				);
				
				$this->addColumn(
					'transaction_date',
					[
						'header' => __('Transaction Date'),
						'index' => 'transaction_date',
						'type'      => 'datetime',
					]
				);
                
                $this->addColumn(
					'amount',
					[
						'header' => __('Transaction Amount'),
						'index' => 'amount',
					]
				);
					
						
						$this->addColumn(
							'status',
							[
								'header' => __('Status'),
								'index' => 'status',
								'type' => 'options',
								'options' => \Magentomaster\Marketplace\Block\Adminhtml\Transactions\Grid::getOptionArray3()
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
					'vendor_ack',
					[
						'header' => __('Acknowledgement'),
						'index' => 'vendor_ack',
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
        //$this->getMassactionBlock()->setTemplate('Magentomaster_Marketplace::transactions/grid/massaction_extended.phtml');
        $this->getMassactionBlock()->setFormFieldName('transactions');

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
     * @param \Magentomaster\Marketplace\Model\transactions|\Magento\Framework\Object $row
     * @return string
     */
    public function getRowUrl($row)
    {
		
        return $this->getUrl(
            'marketplace/*/edit',
            ['id' => $row->getId()]
        );
		
    }

	
		static public function getOptionArray3()
		{
            $data_array=array(); 
			$data_array[0]='Paid';
			$data_array[1]='Unpaid';
            return($data_array);
		}
		static public function getValueArray3()
		{
            $data_array=array();
			foreach(\Magentomaster\Marketplace\Block\Adminhtml\Transactions\Grid::getOptionArray3() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}