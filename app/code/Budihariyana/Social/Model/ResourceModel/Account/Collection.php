<?php
namespace Budihariyana\Social\Model\ResourceModel\Account;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Budihariyana\Social\Model\Account','Budihariyana\Social\Model\ResourceModel\Account');
    }
}
