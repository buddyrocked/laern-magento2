<?php
namespace Budihariyana\Banner\Model\ResourceModel;
class BannerItem extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('budihariyana_banner_banneritem','budihariyana_banner_banneritem_id');
    }
}
