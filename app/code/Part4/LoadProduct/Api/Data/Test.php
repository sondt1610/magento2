<?php
namespace Part4\LoadProduct\Api\Data;


interface Test
{
    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get URL Key
     *
     * @return string
     */
    public function getUrlKey();
}