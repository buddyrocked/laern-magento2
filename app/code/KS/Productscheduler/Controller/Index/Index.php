<?php


namespace KS\Productscheduler\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /*$objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');

        $collection = $productCollection->create()
                    ->addAttributeToSelect('*')
                    ->addAttributeToFilter('start_date', ['lteq'=>date('Y-m-d h:i:s')])
                    ->addAttributeToFilter('end_date', ['gteq'=>date('Y-m-d h:i:s')])
                    ->load();

        foreach ($collection as $product){
            var_dump($product);
        }*/

        return $this->resultPageFactory->create();
    }
}
