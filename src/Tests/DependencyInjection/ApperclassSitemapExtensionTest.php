<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\DependencyInjection;

use Apperclass\Bundle\SitemapBundle\DependencyInjection\ApperclassSitemapExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ApperclassSitemapExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ApperclassSitemapExtension
     */
    private $extension;

    /**
     * Root name of the configuration
     *
     * @var string
     */
    private $root;

    public function setUp()
    {
        parent::setUp();

        $this->extension = $this->getExtension();
        $this->root      = 'apperclass_sitemap';
    }

    public function testGetConfigWithDefaultValues()
    {
        $this->extension->load(array(), $container = $this->getContainer());

        $this->assertTrue($container->hasParameter($this->root . '.path'));
        $this->assertEquals('%kernel.root_dir%/../web/sitemap.xml', $container->getParameter($this->root . '.path'));
    }

    public function testGetConfigWithOverrideValues()
    {
        $configs = array(
            'path'     => '/foo/bar/sitemap.xml'
        );

        $this->extension->load(array($configs), $container = $this->getContainer());

        $this->assertTrue($container->hasParameter($this->root . '.path'));
        $this->assertEquals('/foo/bar/sitemap.xml', $container->getParameter($this->root . '.path'));
    }

    /**
     * @return ApperclassSitemapExtension
     */
    protected function getExtension()
    {
        return new ApperclassSitemapExtension();
    }

    /**
     * @return ContainerBuilder
     */
    private function getContainer()
    {
        return (new ContainerBuilder());
    }
}