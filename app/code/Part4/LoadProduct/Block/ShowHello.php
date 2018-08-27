<?php
namespace Part4\LoadProduct\Block;
class ShowHello extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function display()
    {
        return 'aaaaaa';
    }
    public function setTitle()
    {
        return "test";
    }

}