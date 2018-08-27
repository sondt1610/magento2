<?php
namespace Demo\Test\Model\ResourceModel;

class Test extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected function _construct()
    {
        //Table name + primary c
        $this->_init('cowell_test','id');
    }
}