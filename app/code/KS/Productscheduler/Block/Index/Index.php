<?php


namespace KS\Productscheduler\Block\Index;

class Index extends \Magento\Framework\View\Element\Template
{
	protected $_productCollectionFactory;

	public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
        array $data = []
    ){
			$this->_productCollectionFactory = $productCollectionFactory;
			parent::__construct($context, $data);
	}

    function _prepareLayout(){
        
    }

    public function getProductCollection()
    {
        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('start_date, end_date, scheduler_status');
        return $collection;
    }
}
