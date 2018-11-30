<?php
namespace Robin\Banner\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class UpgradeSchema implements UpgradeSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();
        if (version_compare($context->getVersion(), "1.0.3", "<")) {
            //Your upgrade script
        }
        if (version_compare($context->getVersion(), '1.0.3', '<')) {
            $connection = $setup->getConnection();
            $salesCompanyTable = $setup->getTable("sales_company");
            $shopTable = $setup->getTable("shop");

            if($connection->isTableExists($salesCompanyTable) != true)
            {
                $table = $connection->newTable($salesCompanyTable)->addColumn(
                    "sales_company_id",
                    Table::TYPE_INTEGER,
                    10,
                    ["primary" => true, "nullable"=>false, 'unsigned' => true, "identity"=>true]
                )->addColumn(
                    "code",
                    Table::TYPE_TEXT,
                    5,
                    ["nullable"=>false]
                )->addColumn(
                    "name",
                    Table::TYPE_TEXT,
                    255,
                    ["nullable"=>false]
                )->addIndex(
                    $setup->getIdxName(
                        'sales_company_id',
                        ['code'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    'code',
                    ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                )->setOption("charset","utf8");

                $connection->createTable($table);
            }

            if($connection->isTableExists($shopTable) != true)
            {
                $table = $connection->newTable($shopTable)->addColumn(
                    "shop_id",
                    Table::TYPE_INTEGER,
                    10,
                    ["primary" => true, "nullable"=>false, 'unsigned' => true, "identity"=>true]
                )->addColumn(
                    "sales_company_id",
                    Table::TYPE_INTEGER,
                    10,
                    ["nullable"=>false, 'unsigned' => true]
                )->addColumn(
                    "code",
                    Table::TYPE_TEXT,
                    3,
                    ["nullable"=>false]
                )->addColumn(
                    "name",
                    Table::TYPE_TEXT,
                    255,
                    ["nullable"=>false]
                )->addColumn(
                    "name_kana",
                    Table::TYPE_TEXT,
                    255,
                    ["nullable"=>false]
                )->addColumn(
                    "zip",
                    Table::TYPE_TEXT,
                    8,
                    ["nullable"=>false]
                )->addColumn(
                    "address",
                    Table::TYPE_TEXT,
                    255,
                    ["nullable"=>false]
                )->addIndex(
                    $setup->getIdxName(
                        'shop',
                        ['code'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
                    ),
                    'code',
                    ['type' => \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE]
                )->addForeignKey(
                    $setup->getFkName(
                        'shop',
                        'sales_company_id',
                        'sales_company',
                        'sales_company_id'
                    ),
                    'sales_company_id',
                    $setup->getTable('sales_company'),
                    'sales_company_id',
                    Table::ACTION_CASCADE
                )->setOption("charset","utf8");

                $connection->createTable($table);
            }
        }
        $setup->endSetup();
    }
}
?>
//namespace Robin\Banner\Setup;
//use Magento\Framework\Setup\SchemaSetupInterface;
//use Magento\Framework\Setup\ModuleContextInterface;
//use Magento\Framework\DB\Ddl\Table;
//class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
//{
//    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
//    {
//        $setup->startSetup();
//        $connection = $setup->getConnection();
//        $tableName = $setup->getTable('banner');
//        $connection->addIndex(
//            $tableName,
//            'search',
//            [
//                'image',
//                'link'
//            ],
//            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
//        );
//        $setup->endSetup();
//    }
//}
//namespace Robin\Banner\Setup;
//use Magento\Framework\Setup\SchemaSetupInterface;
//use Magento\Framework\Setup\ModuleContextInterface;
//use Magento\Framework\DB\Ddl\Table;
//class UpgradeSchema implements \Magento\Framework\Setup\UpgradeSchemaInterface
//{
//    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
//    {
//        $setup->startSetup();
//        $connection = $setup->getConnection();
//        $tableName = $setup->getTable('banner');
//        // Check if the table is not exists
//        if ($connection->isTableExists($tableName) != true) {
//            // Create table
//            $table = $connection->newTable($tableName)->addColumn(
//                'id',
//                Table::TYPE_INTEGER,
//                null,
//                ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true]
//            )->addColumn(
//                'image',
//                Table::TYPE_TEXT,
//                255,
//                ['nullable' => false, 'default' => '']
//            )->addColumn(
//                'link',
//                Table::TYPE_TEXT,
//                255,
//                ['nullable' => false, 'default' => '']
//            )->addColumn(
//                'sort_order',
//                Table::TYPE_SMALLINT,
//                255,
//                ['nullable' => false, 'default' => 0]
//            )->addColumn(
//                'status',
//                Table::TYPE_BOOLEAN,
//                null,
//                ['nullable' => false, 'default' => false]
//            )->setOption('charset', 'utf8');
//            $connection->createTable($table);
//        } else {
//            // Add column "sort_order" and "status"
//            $setup->run("ALTER TABLE " . $tableName . " ADD COLUMN sort_order SMALLINT, ADD COLUMN status BOOLEAN;");
//        }
//        $setup->endSetup();
//    }
//}