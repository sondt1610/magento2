<?php

namespace Demo\Test\Plugin;

class ExamplePlugin
{
    public function beforeSetTitle(\Demo\Test\Controller\Index\Example $subject, $title)
    {
//        $subject->title = "mmm";
//        echo $subject->title;
        $title = $title . " to ";
        //echo $title;
        //echo __METHOD__ . "</br>";

        return [$title];
    }

//    public function afterGetTitle(\Demo\Test\Controller\Index\Example $subject, $result)
//    {
//        echo $result;
//        return '<h1>'. $result . 'Mageplaza.com' .'</h1>';
//
//    }

//    public function aroundGetTitle(\Demo\Test\Controller\Index\Example $subject, callable $proceed)
//    {
//        echo __METHOD__ . " - Before proceed() </br>";
//        $result = $proceed();
//        //echo $result;
//        echo __METHOD__ . " - After proceed() </br>";
//
//        $result = 'fdgd';
//        return $result;
//    }

}