<?php
namespace Part4\LoadProduct\Block;
class DisplayHello extends \Part4\LoadProduct\Block\ShowHello
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function display()
    {
        echo parent::setTitle();
        return 'mmm';
    }
}