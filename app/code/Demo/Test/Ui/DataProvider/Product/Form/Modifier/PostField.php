<?php
namespace Demo\Test\Ui\DataProvider\Product\Form\Modifier;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Ui\Component\Form\Fieldset;
use Magento\Ui\Component\Form\Field;
use Magento\Ui\Component\Form\Element\Select;
use Magento\Ui\Component\Form\Element\DataType\Text;
class PostField extends AbstractModifier
{
    private $locator;
    protected $_curl;
    protected $_scopeConfig;
    protected $_slugify;
    protected $_cmsResource;
    protected $_cache;
    protected $_apiUrl;
    protected $_productBlock;

    public function __construct(
        LocatorInterface $locator,
        \Magento\Framework\HTTP\Client\Curl $curl,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig

    ) {
        $this->locator = $locator;
        $this->_curl = $curl;
        $this->_scopeConfig = $scopeConfig;
    }

    public function modifyData(array $data)
    {
        return $data;
    }

    public function modifyMeta(array $meta)
    {
        $meta = array_replace_recursive(
            $meta,
            [
                'custom_fieldset' => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'label' => __('Drupal Connect'),
                                'componentType' => Fieldset::NAME,
                                'dataScope' => 'data.product.custom_fieldset',
                                'collapsible' => true,
                                'sortOrder' => 5,
                            ],
                        ],
                    ],
                    'children' => [
                        'custom_field' => $this->getCustomField()
                    ],
                ]
            ]
        );
        return $meta;
    }

    public function getCustomField()
    {
        return [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => __('Keywords'),
                        'componentType' => Field::NAME,
                        'formElement' => 'input',
                        'dataScope' => 'post',
                        'dataType' => Text::NAME,
                        'sortOrder' => 10
                    ],
                ],
            ],
        ];
    }
}