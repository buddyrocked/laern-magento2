<?php
namespace Budihariyana\Social\Model\ResourceModel;
class Account extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('budihariyana_social_account','id');
    }
}
