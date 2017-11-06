<?php
namespace Budihariyana\Banner\Model\ResourceModel\BannerItem;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Budihariyana\Banner\Model\BannerItem','Budihariyana\Banner\Model\ResourceModel\BannerItem');
    }
}
