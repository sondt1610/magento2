<?php

namespace Demo\Test\Controller\Index;

class Example extends \Magento\Framework\App\Action\Action
{

    public $title;

    public function execute()
    {
        $a = $this->setTitle('Welcome ');
        echo $a;
        echo $this->getTitle();
    }

    public function setTitle($title)
    {
        return $this->title = $title;
    }

    public function getTitle()
    {
        $this->title = 'dddd';
        return $this->title;
    }
}