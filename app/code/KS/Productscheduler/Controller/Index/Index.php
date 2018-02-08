<?php


namespace KS\Productscheduler\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $resultPageFactory;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /*$objectManager = \Magento\Framework\App\ObjectManager::getInstance();

        $productCollection = $objectManager->create('Magento\Catalog\Model\ResourceModel\Product\CollectionFactory');

        $collection = $productCollection->create()
                    ->addAttributeToSelect('*')
                    ->addAttributeToFilter('status', 1)
                    ->addAttributeToFilter('scheduler_status', 1)
                    ->addAttributeToFilter('start_date', ['lteq'=>date('Y-m-d 00:00:00')])
                    ->addAttributeToFilter('end_date', ['gteq'=>date('Y-m-d 00:00:00')])
                    ->addAttributeToFilter('start_time', ['lteq'=>date('G')])                    
                    ->addAttributeToFilter('end_time', ['gteq'=>date('G')])
                    ->load();
        echo date('Y-m-d h:i:s');
        var_dump($collection->getData());
        echo $collection->getSelect()->__toString(); die();

        /*foreach ($collection as $product){
            var_dump($product);
        }*/

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();

        $sql = "UPDATE `catalog_product_entity_int` `at_status`
        
                INNER JOIN `catalog_product_entity` AS `e` ON (`at_status`.`entity_id` = `e`.`entity_id`)
                INNER JOIN `eav_attribute` AS `eas` ON (`eas`.`attribute_id` = `at_status`.`attribute_id` AND `eas`.`attribute_code` = 'status')

                INNER JOIN `catalog_product_entity_int` AS `at_scheduler_status` ON (`at_scheduler_status`.`entity_id` = `e`.`entity_id`) AND (`at_scheduler_status`.`store_id` = 0)
                INNER JOIN `eav_attribute` AS `eass` ON (`eass`.`attribute_id` = `at_scheduler_status`.`attribute_id` AND `eass`.`attribute_code` = 'scheduler_status')

                INNER JOIN `catalog_product_entity_datetime` AS `at_start_date` ON (`at_start_date`.`entity_id` = `e`.`entity_id`) AND (`at_start_date`.`store_id` = 0)
                INNER JOIN `eav_attribute` AS `easd` ON (`easd`.`attribute_id` = `at_start_date`.`attribute_id` AND `easd`.`attribute_code` = 'start_date')

                INNER JOIN `catalog_product_entity_datetime` AS `at_end_date` ON (`at_end_date`.`entity_id` = `e`.`entity_id`) AND (`at_end_date`.`store_id` = 0)
                INNER JOIN `eav_attribute` AS `eaed` ON (`eaed`.`attribute_id` = `at_end_date`.`attribute_id` AND `eaed`.`attribute_code` = 'end_date')

                INNER JOIN 
                    `catalog_product_entity_int` AS `at_start_time` ON (`at_start_time`.`entity_id` = `e`.`entity_id`) 
                INNER JOIN
                    `eav_attribute` AS `east` ON (`east`.`attribute_id` = `at_start_time`.`attribute_id` AND `east`.`attribute_code` = 'start_time')

                INNER JOIN 
                    `catalog_product_entity_int` AS `at_end_time` ON (`at_end_time`.`entity_id` = `e`.`entity_id`) 
                INNER JOIN
                    `eav_attribute` AS `eaet` ON (`eaet`.`attribute_id` = `at_end_time`.`attribute_id` AND `eaet`.`attribute_code` = 'end_time')

                SET `at_status`.`value` = `at_scheduler_status`.`value`

                WHERE   (`at_scheduler_status`.`value` <> `at_status`.`value`) AND
                        (`at_start_date`.`value` <= '".date('Y-m-d 00:00:00')."') AND
                        (`at_end_date`.`value` >= '".date('Y-m-d 00:00:00')."') AND
                        (`at_start_time`.`value` <= '".date('G')."') AND
                        (`at_end_time`.`value` >= '".date('G')."')"

                ;

        $connection->query($sql);

        $sql2 = "UPDATE `catalog_product_entity_int` `at_status`
        
                INNER JOIN `catalog_product_entity` AS `e` ON (`at_status`.`entity_id` = `e`.`entity_id`)
                INNER JOIN `eav_attribute` AS `eas` ON (`eas`.`attribute_id` = `at_status`.`attribute_id` AND `eas`.`attribute_code` = 'status')

                INNER JOIN `catalog_product_entity_int` AS `at_scheduler_status` ON (`at_scheduler_status`.`entity_id` = `e`.`entity_id`) AND (`at_scheduler_status`.`store_id` = 0)
                INNER JOIN `eav_attribute` AS `eass` ON (`eass`.`attribute_id` = `at_scheduler_status`.`attribute_id` AND `eass`.`attribute_code` = 'scheduler_status')

                INNER JOIN `catalog_product_entity_datetime` AS `at_start_date` ON (`at_start_date`.`entity_id` = `e`.`entity_id`) AND (`at_start_date`.`store_id` = 0)
                INNER JOIN `eav_attribute` AS `easd` ON (`easd`.`attribute_id` = `at_start_date`.`attribute_id` AND `easd`.`attribute_code` = 'start_date')

                INNER JOIN `catalog_product_entity_datetime` AS `at_end_date` ON (`at_end_date`.`entity_id` = `e`.`entity_id`) AND (`at_end_date`.`store_id` = 0)
                INNER JOIN `eav_attribute` AS `eaed` ON (`eaed`.`attribute_id` = `at_end_date`.`attribute_id` AND `eaed`.`attribute_code` = 'end_date')

                INNER JOIN 
                    `catalog_product_entity_int` AS `at_start_time` ON (`at_start_time`.`entity_id` = `e`.`entity_id`) 
                INNER JOIN
                    `eav_attribute` AS `east` ON (`east`.`attribute_id` = `at_start_time`.`attribute_id` AND `east`.`attribute_code` = 'start_time')

                INNER JOIN 
                    `catalog_product_entity_int` AS `at_end_time` ON (`at_end_time`.`entity_id` = `e`.`entity_id`) 
                INNER JOIN
                    `eav_attribute` AS `eaet` ON (`eaet`.`attribute_id` = `at_end_time`.`attribute_id` AND `eaet`.`attribute_code` = 'end_time')

                SET `at_status`.`value` = IF(`at_scheduler_status`.`value` = 1, 2, 1)

                WHERE   (`at_scheduler_status`.`value` = `at_status`.`value`) AND
                        (`at_end_date`.`value` < '".date('Y-m-d 00:00:00')."') AND
                        (`at_end_time`.`value` < '".date('G')."')"
                ;

        $connection->query($sql2); die(date('Y-m-d h:i:s'));

        return $this->resultPageFactory->create();
    }
}
