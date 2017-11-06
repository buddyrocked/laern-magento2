<?php
namespace Budihariyana\Social\Api;

use Budihariyana\Social\Model\AccountInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface AccountRepositoryInterface 
{
    public function save(AccountInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(AccountInterface $page);

    public function deleteById($id);
}
