<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Robin\Banner\Block\Adminhtml\Banner\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class DeleteButton
 */
class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Create Button
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getBannerId()) {
            $data = [
                'label' => __('Delete Image'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
    /**
     * Get URL for Button
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['id' => $this->getBannerId()]);
    }
}
