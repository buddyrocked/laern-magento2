<?php
namespace Budihariyana\Social\Model;
class Account extends \Magento\Framework\Model\AbstractModel implements AccountInterface, \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'budihariyana_social_account';

    protected function _construct()
    {
        $this->_init('Budihariyana\Social\Model\ResourceModel\Account');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
