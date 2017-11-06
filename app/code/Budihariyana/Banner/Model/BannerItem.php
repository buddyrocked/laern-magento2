<?php
namespace Budihariyana\Banner\Model;
class BannerItem extends \Magento\Framework\Model\AbstractModel implements \Budihariyana\Banner\Api\Data\BannerItemInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'budihariyana_banner_banneritem';

    protected function _construct()
    {
        $this->_init('Budihariyana\Banner\Model\ResourceModel\BannerItem');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
