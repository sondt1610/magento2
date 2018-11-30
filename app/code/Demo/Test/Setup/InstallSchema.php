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
         * Create table 'cowell_test'
         */
        //if (version_compare($context->getVersion(), '1.0.0', '<')) {
            $table = $installer->getConnection()
                ->newTable(
                    $installer->getTable('drupal_blog')
                )
                ->addColumn(
                    'product_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    ['unsigned' => true, 'nullable' => false, 'primary' => true],
                    'Product ID'
                )
                ->addColumn(
                    'blog_keyword',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => true],
                    'blog_keyword'
                )
                ->addForeignKey(
                    $installer->getFkName('drupal_blog', 'product_id', 'catalog_product_entity', 'entity_id'),
                    'product_id',
                    $installer->getTable('catalog_product_entity'),
                    'entity_id',
                    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
                )
                ->setComment(
                    'Catalog Product To Website Linkage Table'
                );
            $installer->getConnection()->createTable($table);

        //}
        $installer->endSetup();
    }


}
//$table = $installer->getConnection()->newTable(
//    $installer->getTable('cowell_banner')
//)->addColumn(
//    "id",
//    Table::TYPE_INTEGER,
//    null,
//    ["primary" => true, "nullable"=>false, "identity"=>true]
//)->addColumn(
//    "image",
//    Table::TYPE_TEXT,
//    255,
//    ["nullable"=>false]
//)->addColumn(
//    "link",
//    Table::TYPE_TEXT,
//    255,
//    ["nullable"=>false]
//)->setOption("charset","utf8");
//$installer->getConnection()->createTable($table);
//
///**
// * Create table 'cowell_test'
// */
//$table = $installer->getConnection()->newTable(
//    $installer->getTable('cowell_test')
//)->addColumn(
//    "id",
//    Table::TYPE_INTEGER,
//    null,
//    ["primary" => true, "nullable"=>false, "identity"=>true]
//)->addColumn(
//    "abc",
//    Table::TYPE_TEXT,
//    255,
//    ["nullable"=>false]
//)->addColumn(
//    "banner_id",
//    Table::TYPE_INTEGER,
//    null,
//    ["nullable"=>false]
//)->addForeignKey(
//    $installer->getFkName('cowell_test', 'banner_id', 'cowell_banner', 'id'),
//    'banner_id',
//    $installer->getTable('cowell_banner'),
//    'id',
//    \Magento\Framework\DB\Ddl\Table::ACTION_CASCADE
//)->setComment(
//    'CMS Block To Store Linkage Table'
//);
