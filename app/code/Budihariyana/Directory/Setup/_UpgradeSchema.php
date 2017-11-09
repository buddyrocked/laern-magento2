<?php
namespace Budihariyana\Social\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

class UpgradeSchema implements UpgradeSchemaInterface {
	
	public function upgrade(
		SchemaSetupInterface $setup, 
		ModuleContextInterface $context
	){
		$installer = $setup;
		$installer->startSetup();

		if(version_compare($context->getVersion(), '0.0.2', '<')):
			/**
	         * Create table 'budihariyana_directory_province'
	         */
	        $table = $setup->getConnection()->newTable(
	            $setup->getTable('budihariyana_directory_province')
	        )->addColumn(
	            'id',
	            Table::TYPE_SMALLINT,
	            null,
	            ['identity' => true, 'nullable' => false, 'primary' => true],
	            'Province ID'
	        )->addColumn(
	            'country_id',
	            Table::TYPE_SMALLINT,
	            null,
	            ['identity' => true, 'nullable' => false, 'primary' => true],
	            'Country ID'
	        )->addColumn(
	            'code',
	            Table::TYPE_TEXT,
	            100,
	            ['nullable' => false],
	            'Country Code'
	        )->addColumn(
	            'name',
	            Table::TYPE_TEXT,
	            100,
	            ['nullable' => false],
	            'Country Name'
	        )->addColumn(
	            'code',
	            Table::TYPE_TEXT,
	            100,
	            ['nullable' => false],
	            'Country Identifier'
	        )->addColumn(
	            'creation_time',
	            Table::TYPE_TIMESTAMP,
	            null,
	            [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT, ],
	            'Creation Time'
	        )->addColumn(
	            'update_time',
	            Table::TYPE_TIMESTAMP,
	            null,
	            [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE, ],
	            'Modification Time'
	        )->addColumn(
	            'is_active',
	            Table::TYPE_SMALLINT,
	            null,
	            [ 'nullable' => false, 'default' => '1', ],
	            'Is Active'
	        )->addIndex(
	            $setup->getIdxName(
	                $setup->getTable('budihariyana_directory_province'),
	                ['code'],
	                AdapterInterface::INDEX_TYPE_FULLTEXT
	            ),
	            ['code'],
	            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
	        )->setComment(
	            'Country Table'
	        )->addForeignKey(
	            $installer->getFkName(
	                'budihariyana_directory_province',
	                'id',
	                'budihariyana_directory_country',
	                'id'
	            ),
	            'id',
	            $installer->getTable('budihariyana_directory_country'), 
	            'id',
	            Table::ACTION_CASCADE
	        );

	        // Add more columns here

	        $setup->getConnection()->createTable($table);

		endif;

		$setup->endSetup();
	}
}