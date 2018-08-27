<?php
namespace Robin\Bai2\Model\ResourceModel\Banner;

use Robin\Bai2\Model\Banner;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(Banner::class, \Robin\Bai2\Model\ResourceModel\Banner::class);
    }
}
//Ten thu muc phai trung voi ten model