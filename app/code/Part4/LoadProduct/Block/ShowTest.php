<?php
namespace Part4\LoadProduct\Block;
class ShowTest extends \Magento\Framework\View\Element\Template implements \Part4\LoadProduct\Api\Data\Test
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getId()
    {
        return '44444';
    }

    public function getUrlKey()
    {
        return '565555';
    }
}