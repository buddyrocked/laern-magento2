<?php
namespace Budihariyana\Social\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface {
	public function upgrade(
		SchemaSetupInterface $setup, 
		ModuleContextInterface $context
	){
		$installer = $setup;
		$installer->startSetup();

		if(version_compare($context->getVersion(), '0.1.1', '<')):
			$table = $installer->getTable('budihariyana_social_account');
			$installer->getConnection()->addColumn($table, 'description', [
				'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                'length'    => 255,
                'unsigned' => true,
                'nullable' => false,
                'default' => '0',
                'comment' => 'Description'
			]);
		endif;
	}
}