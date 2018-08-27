<?php
namespace Robin\Banner\Model\ResourceModel\Banner;

use Robin\Banner\Model\Banner;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected function _construct()
    {
        $this->_init(Banner::class, \Robin\Banner\Model\ResourceModel\Banner::class);
    }
}
//Ten thu muc phai trung voi ten model