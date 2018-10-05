<?php

namespace OpenTechiz\Blog\Controller\Index;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $_resultPageFactory;

    protected $dateTime;

    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
        //step 1:  Stores -> Configuration -> General -> General. Scroll down to Locale Options.Choose Indochina(Asia/HCM)
        //step 2: get time of VietNamese
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->dateTime = $objectManager->get(\Magento\Framework\Stdlib\DateTime\TimezoneInterface::class);
        print_r($this->dateTime->getConfigTimezone());
        $time = $this->dateTime->date()->format('Y-m-d H:i:s');
        //echo $time;

        // Write to default log file: var/log/system.log
//        $this->_logger->info($time);
        //Output: [2017-02-22 04:52:56] main.INFO: $time [] []

//        $debugBackTrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
//        foreach ($debugBackTrace as $item) {
//            echo @$item['class'] . "</br>".@$item['type'] . "</br>" . @$item['function'] . "</br>";
//        }
//        die();
        $resultPage = $this->_resultPageFactory->create();
        return $resultPage;
    }
}