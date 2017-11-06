<?php
namespace Budihariyana\Banner\Api;

use Budihariyana\Banner\Api\Data\BannerItemInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Api\SearchCriteriaInterface;

interface BannerItemRepositoryInterface 
{
    public function save(BannerItemInterface $page);

    public function getById($id);

    public function getList(SearchCriteriaInterface $criteria);

    public function delete(BannerItemInterface $page);

    public function deleteById($id);
}
