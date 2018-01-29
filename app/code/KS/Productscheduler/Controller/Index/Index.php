<?php
namespace KS\Productscheduler\Controller\Index;
class Index extends \Magento\Framework\App\Action\Action
{
    protected $resultPageFactory;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;        
        return parent::__construct($context);
    }
    
    public function execute()
    {
        return $this->resultPageFactory->create();  
    }

    public function _updateStatus(){

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $resource = $objectManager->get('Magento\Framework\App\ResourceConnection');
        $connection = $resource->getConnection();       

        $sql = "UPDATE `catalog_product_entity_int` `at_status`

                INNER JOIN `catalog_product_entity` AS `e` ON (`at_status`.`entity_id` = `e`.`entity_id`) AND (`at_status`.`attribute_id` = '97') AND (`at_status`.`store_id` = 0)
                INNER JOIN `eav_attribute` AS `east` ON (`east`.`attribute_id` = `at_status`.`attribute_id` AND `east`.`attribute_code` = 'status')

                INNER JOIN `catalog_product_entity_int` AS `at_scheduler_status` ON (`at_scheduler_status`.`entity_id` = `e`.`entity_id`) AND (`at_scheduler_status`.`store_id` = 0)
                INNER JOIN `eav_attribute` AS `eas` ON (`eas`.`attribute_id` = `at_scheduler_status`.`attribute_id` AND `eas`.`attribute_code` = 'scheduler_status')

                INNER JOIN `catalog_product_entity_datetime` AS `at_start_date` ON (`at_start_date`.`entity_id` = `e`.`entity_id`) AND (`at_start_date`.`store_id` = 0)
                INNER JOIN `eav_attribute` AS `easd` ON (`easd`.`attribute_id` = `at_start_date`.`attribute_id` AND `easd`.`attribute_code` = 'start_date')

                INNER JOIN `catalog_product_entity_datetime` AS `at_end_date` ON (`at_end_date`.`entity_id` = `e`.`entity_id`) AND (`at_end_date`.`store_id` = 0)
                INNER JOIN `eav_attribute` AS `eaed` ON (`eaed`.`attribute_id` = `at_end_date`.`attribute_id` AND `eaed`.`attribute_code` = 'end_date')

                SET `at_status`.`value` = `at_scheduler_status`.`value`

                WHERE   (`at_scheduler_status`.`value` <> `at_status`.`value`) AND
                        (`at_start_date`.`value` <= '".date('Y-m-d 00:00:00')."') AND
                        (`at_end_date`.`value` >= '".date('Y-m-d 00:00:00')."')"
                ;

        echo $sql; die;

        $result = $connection->query($sql);

        var_dump($result); die;
    }


}
