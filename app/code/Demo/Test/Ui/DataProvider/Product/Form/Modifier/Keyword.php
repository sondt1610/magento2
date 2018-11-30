<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Demo\Test\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\DB\Helper as DbHelper;
use Magento\Catalog\Model\Category as CategoryModel;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\Stdlib\ArrayManager;

/**
 * Data provider for categories field of product page
 *
 * @api
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @since 101.0.0
 */
class Keyword extends \Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier
{
    /**#@+
     * Category tree cache id
     */
    const CATEGORY_TREE_ID = 'CATALOG_PRODUCT_CATEGORY_TREE';
    /**#@-*/

    /**
     * @var CategoryCollectionFactory
     * @since 101.0.0
     */
    protected $categoryCollectionFactory;

    /**
     * @var DbHelper
     * @since 101.0.0
     */
    protected $dbHelper;

    /**
     * @var array
     * @deprecated 101.0.3
     * @since 101.0.0
     */
    protected $categoriesTrees = [];

    /**
     * @var LocatorInterface
     * @since 101.0.0
     */
    protected $locator;

    /**
     * @var UrlInterface
     * @since 101.0.0
     */
    protected $urlBuilder;

    /**
     * @var ArrayManager
     * @since 101.0.0
     */
    protected $arrayManager;

    /**
     * @var CacheInterface
     */
    private $cacheManager;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @param LocatorInterface $locator
     * @param CategoryCollectionFactory $categoryCollectionFactory
     * @param DbHelper $dbHelper
     * @param UrlInterface $urlBuilder
     * @param ArrayManager $arrayManager
     * @param SerializerInterface $serializer
     */
    public function __construct(
        LocatorInterface $locator,
        CategoryCollectionFactory $categoryCollectionFactory,
        DbHelper $dbHelper,
        UrlInterface $urlBuilder,
        ArrayManager $arrayManager,
        SerializerInterface $serializer = null
    ) {
        $this->locator = $locator;
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->dbHelper = $dbHelper;
        $this->urlBuilder = $urlBuilder;
        $this->arrayManager = $arrayManager;
        $this->serializer = $serializer ?: ObjectManager::getInstance()->get(SerializerInterface::class);
    }

    /**
     * Retrieve cache interface
     *
     * @return CacheInterface
     * @deprecated 101.0.3
     */
    private function getCacheManager()
    {
        if (!$this->cacheManager) {
            $this->cacheManager = ObjectManager::getInstance()
                ->get(CacheInterface::class);
        }
        return $this->cacheManager;
    }

    /**
     * {@inheritdoc}
     * @since 101.0.0
     */
    public function modifyMeta(array $meta)
    {
        $meta = $this->createNewCategoryModal($meta);
        $meta = $this->customizeCategoriesField($meta);

        return $meta;
    }

    /**
     * {@inheritdoc}
     * @since 101.0.0
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * Create slide-out panel for new category creation
     *
     * @param array $meta
     * @return array
     * @since 101.0.0
     */
    protected function createNewCategoryModal(array $meta)
    {
        return $this->arrayManager->set(
            'create_keyword_modal',
            $meta,
            [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'isTemplate' => false,
                            'componentType' => 'modal',
                            'options' => [
                                'title' => __('All post related'),
                            ],
                            'imports' => [
                                'state' => '!index=create_category:responseStatus'
                            ],
                        ],
                    ],
                ],
                'children' => [
                    'create_category' => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'label' => '',
                                    'componentType' => 'container',
                                    'component' => 'Magento_Ui/js/form/components/insert-form',
                                    'dataScope' => '',
                                    'update_url' => $this->urlBuilder->getUrl('mui/index/render'),
                                    'render_url' => $this->urlBuilder->getUrl(
                                        'mui/index/render_handle',
                                        [
                                            'handle' => 'catalog_category_create',
                                            'store' => $this->locator->getStore()->getId(),
                                            'buttons' => 1
                                        ]
                                    ),
                                    'autoRender' => false,
                                    'ns' => 'new_category_form',
                                    'externalProvider' => 'new_category_form.new_category_form_data_source',
                                    'toolbarContainer' => '${ $.parentName }',
                                    'formSubmitType' => 'ajax',
                                ],
                            ],
                        ]
                    ]
                ]
            ]
        );
    }

    /**
     * Customize Categories field
     *
     * @param array $meta
     * @return array
     * @since 101.0.0
     */
    protected function customizeCategoriesField(array $meta)
    {
        $fieldCode = 'drupal_product_keywords';
        $elementPath = $this->arrayManager->findPath($fieldCode, $meta, null, 'children');
        $containerPath = $this->arrayManager->findPath(static::CONTAINER_PREFIX . $fieldCode, $meta, null, 'children');

        if (!$elementPath) {
            return $meta;
        }

        $meta = $this->arrayManager->merge(
            $containerPath,
            $meta,
            [
                'arguments' => [
                    'data' => [
                        'config' => [
                            'label' => __('Post'),
                            'dataScope' => '',
                            'breakLine' => false,
                            'formElement' => 'container',
                            'componentType' => 'container',
                            'component' => 'Magento_Ui/js/form/components/group',
                            'scopeLabel' => __('[GLOBAL]'),
                        ],
                    ],
                ],
                'children' => [
                    'create_category_button' => [
                        'arguments' => [
                            'data' => [
                                'config' => [
                                    'title' => __('New post'),
                                    'formElement' => 'container',
                                    'additionalClasses' => 'admin__field-small',
                                    'componentType' => 'container',
                                    'component' => 'Magento_Ui/js/form/components/button',
                                    'template' => 'ui/form/components/button/container',
                                    'actions' => [
                                        [
                                            'targetName' => 'product_form.product_form.create_category_modal',
                                            'actionName' => 'toggleModal',
                                        ],
                                        [
                                            'targetName' =>
                                                'product_form.product_form.create_category_modal.create_category',
                                            'actionName' => 'render'
                                        ],
                                        [
                                            'targetName' =>
                                                'product_form.product_form.create_category_modal.create_category',
                                            'actionName' => 'resetForm'
                                        ]
                                    ],
                                    'additionalForGroup' => true,
                                    'provider' => false,
                                    'source' => 'product_details',
                                    'displayArea' => 'insideGroup',
                                    'sortOrder' => 20,
                                ],
                            ],
                        ]
                    ]
                ]
            ]
        );

        return $meta;
    }
}
