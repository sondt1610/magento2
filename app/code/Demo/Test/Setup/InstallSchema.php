<?php

namespace Demo\Test\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
         * Create table 'cowell_banner'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('cowell_banner')
        )->addColumn(
            "id",
            Table::TYPE_INTEGER,
            null,
            ["primary" => true, "nullable"=>false, "identity"=>true]
        )->addColumn(
            "image",
            Table::TYPE_TEXT,
            255,
            ["nullable"=>false]
        )->addColumn(
            "link",
            Table::TYPE_TEXT,
            255,
            ["nullable"=>false]
        )->setOption("charset","utf8");
        $installer->getConnection()->createTable($table);

        /**
         * Create table 'cowell_test'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('cowell_test')
        )->addColumn(
            "id",
            Table::TYPE_INTEGER,
            null,
            ["primary" => true, "nullable"=>false, "identity"=>true]
        )->addColumn(
            "abc",
            Table::TYPE_TEXT,
            255,
            ["nullable"=>false]
        )->addColumn(
            "banner_id",
            Table::TYPE_INTEGER,
            null,
            ["nullable"=>false]
        )->addForeignKey(
            $installer->getFkName('cowell_test', 'banner_id', 'cowell_banner', 'id'),
            'banner_id',
            $installer->getTable('cowell_banner'),
            'id',
            \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
        )->setComment(
            'CMS Block To Store Linkage Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();
    }


}
