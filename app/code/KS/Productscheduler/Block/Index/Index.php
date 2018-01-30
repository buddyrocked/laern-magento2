<?php


namespace KS\Productscheduler\Block\Index;

class Index extends \Magento\Framework\View\Element\Template
{

    protected $_productCollectionFactory;
        
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,        
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,        
        array $data = []
    )
    {    
        $this->_productCollectionFactory = $productCollectionFactory;    
        parent::__construct($context, $data);
    }

    public function _prepareLayout(){

    }
	

    public function _getProductCollection()
    {
        $arrProducts = [];

        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('start_date', ['lteq'=>date('Y-m-d h:i:s')]);
        $collection->addAttributeToFilter('end_date', ['gteq'=>date('Y-m-d h:i:s')]);

        if($collection->count() > 0):
            foreach($collection->load() as $key=>$product):
                $arrProducts[$key]['name'] = $product->getName();
                $arrProducts[$key]['sku'] = $product->getSku();
                $arrProducts[$key]['scheduler_status'] = ($product->getSchedulerStatus() == 1)?'Enable':'Disable';
                $arrProducts[$key]['start_date'] = $product->getStartDate();
                $arrProducts[$key]['end_date'] = $product->getEndDate();
            endforeach;
        endif;

        return $arrProducts;
    }
}
