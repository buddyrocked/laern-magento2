<?php
/**
 * installSchema.php
 *
 * @copyright Copyright © 2017 Budihariyana. All rights reserved.
 * @author    budihariyana@gmail.com
 */
namespace Budihariyana\Directory\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context) //@codingStandardsIgnoreLine
    {
        $setup->startSetup();

        /**
         * Create table 'budihariyana_directory_country'
         */
        $table = $setup->getConnection()->newTable(
            $setup->getTable('budihariyana_directory_country')
        )->addColumn(
            'id',
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
                $setup->getTable('budihariyana_directory_country'),
                ['code'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            ),
            ['code'],
            ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
        )->setComment(
            'Country Table'
        );

        // Add more columns here

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
