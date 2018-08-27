<?php

namespace OpenTechiz\Blog\Controller\Index;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;

    public function __construct(Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }


    public function execute()
    {
//        $debugBackTrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
//        foreach ($debugBackTrace as $item) {
//            echo @$item['class'] . "</br>".@$item['type'] . "</br>" . @$item['function'] . "</br>";
//        }
//        die();
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}