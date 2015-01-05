<?php

namespace Apperclass\Bundle\SitemapBundle\Tests;

use Apperclass\Bundle\SitemapBundle\ApperclassSitemapBundle;

class ApperclassSitemapBundleTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ApperclassSitemapBundle
     */
    private $bundle;

    public function setUp()
    {
        $this->bundle = new ApperclassSitemapBundle();
    }

    public function testAddsCompilerPasses()
    {
        $mock = $this->getContainerBuilderMock();

        $mock
            ->expects($this->exactly(2))
            ->method('addCompilerPass');

        $this->bundle->build($mock);
    }

    protected function getContainerBuilderMock()
    {
        $mock = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        return $mock;
    }
} 