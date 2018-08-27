<?php
namespace Demo\Test\Model;


class Test extends \Magento\Framework\Model\AbstractModel
{
    protected function _construct()
    {
        $this->_init('Demo\Test\Model\ResourceModel\Test');
    }
}