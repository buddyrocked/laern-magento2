<?php


namespace KS\Productscheduler\Block\Index;

class Index extends \Magento\Framework\View\Element\Template
{
	protected $_productFactory;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Catalog\Model\ProductFactory $productFactory){
			$this->_productFactory = $productFactory;
			parent::__construct($context);
	}

    function _prepareLayout(){
    	$this->_getListData();
    }

    protected function _getListData(){
    	$model = $this->_productFactory->create();
    	$collection = $model->getCollection();
    	$this->setProducts($collection->getData());
    }
}
