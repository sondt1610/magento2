<?php
namespace Demo\Test\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    private $eavSetupFactory;

    public function __construct(EavSetupFactory $eavSetupFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
//        $eavSetup->removeAttribute(
//            \Magento\Catalog\Model\Product::ENTITY,
//            'drupal_product_keywords');

        if (version_compare($context->getVersion(), '1.0.0', '<')) {
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Product::ENTITY,
                'drupal_product_keywords',
                [
                    'type' => 'varchar',
                    'backend' => '',
                    'frontend' => '',
                    'label' => 'Drupal connect by keywords',
                    'input' => 'text',
                    'class' => '',
                    'source' => '',
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_GLOBAL,
                    'visible' => true,
                    'required' => false,
                    'user_defined' => false,
                    'default' => '',
                    'searchable' => false,
                    'filterable' => false,
                    'comparable' => false,
                    'visible_on_front' => false,
                    'used_in_product_listing' => true,
                    'unique' => false,
                    'apply_to' => ''
                ]
            );
            $eavSetup->addAttribute(
                \Magento\Catalog\Model\Category::ENTITY,
                'drupal_category_keywords',
                [
                    'type' => 'varchar',
                    'label' => 'Drupal connect by keywords',
                    'input' => 'text',
                    'required' => false,
                    'sort_order' => 4,
                    'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_STORE,
                    'wysiwyg_enabled' => false,
                    'is_html_allowed_on_front' => true,
                    'group' => 'General Information',
                ]
            );
        }
    }
}