<?php
namespace Budihariyana\Banner\Ui\Component\Listing\DataProviders\Budihariyana\Banner;

class Banneritem extends \Magento\Ui\DataProvider\AbstractDataProvider
{    
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        \Budihariyana\Banner\Model\ResourceModel\BannerItem\CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $collectionFactory->create();
    }
}
