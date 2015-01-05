<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\DependencyInjection\Compiler;

use Apperclass\Bundle\SitemapBundle\DependencyInjection\Compiler\SitemapEntitiesProviderCompilerPass;
use Apperclass\Bundle\SitemapBundle\DependencyInjection\Compiler\SitemapUrlProviderCompilerPass;

class SitemapUrlProviderCompilerPassTest extends CompilerPassTestCase
{
    /**
     * @var SitemapEntitiesProviderCompilerPass
     */
    private $compilerPass;

    protected function setUp()
    {
        parent::setUp();

        $this->compilerPass = new SitemapUrlProviderCompilerPass();
    }

    public function testProcessHasNoSitemapGeneratorDefinition()
    {
        $this->containerBuilderMock
             ->expects($this->exactly(1))
             ->method('hasDefinition')
             ->with('apperclass_sitemap.sitemap_provider')
             ->willReturn(false);

        $this->compilerPass->process($this->containerBuilderMock);
    }

    public function testProcess()
    {
        $taggedServices = array('foo'=> 'bar', 'john' => 'doe');

        $this->containerBuilderMock
            ->expects($this->exactly(1))
            ->method('hasDefinition')
            ->with('apperclass_sitemap.sitemap_provider')
            ->willReturn(true);

        $definitionMock = $this->getDefinitionMock();

        $definitionMock
            ->expects($this->exactly(sizeof($taggedServices)))
            ->method('addMethodCall');

        $this->containerBuilderMock
            ->expects($this->exactly(1))
            ->method('getDefinition')
            ->with('apperclass_sitemap.sitemap_provider')
            ->willReturn($definitionMock);

        $this->containerBuilderMock
            ->expects($this->exactly(1))
            ->method('findTaggedServiceIds')
            ->with('apperclass_sitemap.sitemap_url_provider')
            ->willReturn($taggedServices);

        $this->compilerPass->process($this->containerBuilderMock);
    }

}