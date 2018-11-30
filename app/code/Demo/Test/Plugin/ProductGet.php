<?php namespace Demo\Test\Plugin;

use Magento\Catalog\Api\Data\ProductInterface;

class ProductGet
{
    protected $productExtensionFactory;
    protected $productFactory;

    public function __construct(
        \Magento\Catalog\Api\Data\ProductExtensionFactory $productExtensionFactory,
        \Magento\Catalog\Model\ProductFactory $productFactory
    )
    {
        $this->productFactory = $productFactory;
        $this->productExtensionFactory = $productExtensionFactory;
    }

    public function aroundGetById(
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Closure $proceed,
        $productId
    )
    {
        /** @var ProductInterface $product */
        $product = $proceed($productId);

        // If extension attribute is already set, return early.
        if ($product->getExtensionAttributes() && $product->getExtensionAttributes()->getDrupalProductKeywords()) {
            return $product;
        }

        // In the event that extension attribute class has not be instansiated yet.
        // in this event, we create it ourselves.
        if (!$product->getExtensionAttributes()) {
            $productExtension = $this->productExtensionFactory->create();
            $product->setExtensionAttributes($productExtension);
        }

        // Fetch the raw product model (I have not found a better way), and set the data onto our attribute.
        $productModel = $this->productFactory->create()->load($product->getId());
        $product->getExtensionAttributes()
            ->setDrupalProductKeywords($productModel->getData('drupal_product_keywords'));

        return $product;
    }
}