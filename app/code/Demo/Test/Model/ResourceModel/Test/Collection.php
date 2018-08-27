<?php
namespace Demo\Test\Model\ResourceModel\Test;

use Demo\Test\Model\Test;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Test::class, \Demo\Test\Model\ResourceModel\Test::class);
    }
}
//Ten thu muc phai trung voi ten model