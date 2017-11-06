<?php
namespace Budihariyana\Social\Ui\Component\Listing\DataProviders\Budihariyana\Social;

class Account extends \Magento\Ui\DataProvider\AbstractDataProvider
{    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Budihariyana\Social\Model\ResourceModel\Account\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
