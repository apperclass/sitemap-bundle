<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Mock;

abstract class AbstractMockFactory
{
    /** @var \PHPUnit_Framework_TestCase  */
    protected $test;

    public function __construct(\PHPUnit_Framework_TestCase $test)
    {
        $this->test = $test;
    }

    abstract public function getMock();
}