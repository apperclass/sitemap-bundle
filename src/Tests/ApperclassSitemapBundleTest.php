<?php
/**
 * @package Apperclass\Bundle\SitemapBundle\Tests
 * @author Ruben Barilani <ruben.barilani.dev@gmail.com>
 * @date 19/12/14
 * @time 14:53
 * @license http://opensource.org/licenses/MIT MIT license 
 */

namespace Apperclass\Bundle\SitemapBundle\Tests;


use Apperclass\Bundle\SitemapBundle\ApperclassSitemapBundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

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