<?php


namespace KS\Productscheduler\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Setup\EavSetup;

class InstallData implements InstallDataInterface
{

    private $eavSetupFactory;

    /**
     * Constructor
     *
     * @param \Magento\Eav\Setup\EavSetupFactory $eavSetupFactory
     */
    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'start_date',
            [
                'type' => 'datetime',
                'backend' => '',
                'frontend' => '',
                'label' => 'Start Date',
                'input' => 'date',
                'class' => '',
                'source' => '',
                'global' => 1,
                'visible' => true,
                'required' => true,
                'user_defined' => true,
                'default' => null,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => false,
                'unique' => false,
                'apply_to' => '',
                'system' => 1,
                'group' => 'General',
                'option' => array('values' => array(""))
            ]
        );

        $eavSetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'end_date',
            [
                'type' => 'datetime',
                'backend' => '',
                'frontend' => '',
                'label' => 'End Date',
                'input' => 'date',
                'class' => '',
                'source' => '',
                'global' => 1,
                'visible' => true,
                'required' => true,
                'user_defined' => true,
                'default' => null,
                'searchable' => false,
                'filterable' => false,
                'comparable' => false,
                'visible_on_front' => false,
                'used_in_product_listing' => false,
                'unique' => false,
                'apply_to' => '',
                'system' => 1,
                'group' => 'General',
                'option' => array('values' => array(""))
            ]
        );
    }
}