<?php
 
namespace KS\Productscheduler\Model\ResourceModel\Product;
 
class Collection extends \Magento\Catalog\Model\ResourceModel\Product\Collection
{    
    /**
     * Update Data for given condition for collection
     *
     * @param int|string $limit
     * @param int|string $offset
     * @return array
     */
    public function setTableRecords($condition, $columnData)
    {
        return $this->getConnection()->update(
            $this->getTable('catalog_product_entity_int'), 
            $columnData, 
            $where = $condition
        );
    }
}
?>