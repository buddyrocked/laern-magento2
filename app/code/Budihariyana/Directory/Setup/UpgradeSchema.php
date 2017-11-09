<?php
namespace Budihariyana\Directory\Setup;
/**
 * The MIT License (MIT)
 * Copyright (c) 2015 - 2017 Pulse Storm LLC, Alan Storm
 * 
 * Permission is hereby granted, free of charge, to any person obtaining 
 * a copy of this software and associated documentation files (the 
 * "Software"), to deal in the Software without restriction, including 
 * without limitation the rights to use, copy, modify, merge, publish, 
 * distribute, sublicense, and/or sell copies of the Software, and to 
 * permit persons to whom the Software is furnished to do so, subject to 
 * the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included 
 * in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS 
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF 
 * MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY 
 * CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT 
 * OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR 
 * THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    
    protected $scriptHelper;    
    public function __construct(
        \Budihariyana\Directory\Setup\Scripts $scriptHelper
    )
    {
        $this->scriptHelper = $scriptHelper;
    }        

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        SchemaSetupInterface $setup, 
        ModuleContextInterface $context
    )
    {
        $installer = $setup;

        $installer->startSetup();

        $table = $installer;

        if(version_compare($context->getVersion(), '0.0.2', '<')):
            /**
             * Create table 'budihariyana_directory_province'
             */
            $table = $installer->getConnection()->newTable(
                $setup->getTable('budihariyana_directory_province')
            )->addColumn(
                'id',
                Table::TYPE_SMALLINT,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true],
                'Province ID'
            )->addColumn(
                'country_id',
                Table::TYPE_INTEGER,
                null,
                ['unsigned' => true, 'nullable' => false],
                'Country Id'
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
                $installer->getIdxName(
                    $installer->getTable('budihariyana_directory_province'),
                    ['code'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['code'],
                ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
            )->addForeignKey(
                $installer->getFkName(
                    'budihariyana_directory_province',
                    'country_id',
                    'budihariyana_directory_country',
                    'id'
                ),
                'country_id',
                $installer->getTable('budihariyana_directory_country'),
                'id',
                Table::ACTION_CASCADE
            )->setComment(
                'Province Table'
            );

            // Add more columns here
            $setup->getConnection()->createTable($table);

            //add foreignkey
            /*$setup->getConnection()->addForeignKey(
               'budihariyana_directory_province_country_id',
                $installer->getTable('budihariyana_directory_province'),
                'country_id',
                $installer->getTable('budihariyana_directory_country'),
                'id',
                Table::ACTION_CASCADE
            );*/

        endif;

        $this->scriptHelper->run($setup, $context, 'schema');
        $installer->endSetup();
    }      
}
