<?php
namespace Budihariyana\Social\Block;
class Main extends \Magento\Framework\View\Element\Template
{
	protected $_accountFactory;

	public function __construct(
		\Magento\Framework\View\Element\Template\Context $context,
		\Budihariyana\Social\Model\AccountFactory $accountFactory){
			$this->_accountFactory = $accountFactory;
			parent::__construct($context);
	}

    function _prepareLayout(){
    	$this->_getListData();
    }

    protected function _getListData(){
    	$model = $this->_accountFactory->create();
    	$collection = $model->getCollection();
    	$this->setAccounts($collection->getData());
    }
}
