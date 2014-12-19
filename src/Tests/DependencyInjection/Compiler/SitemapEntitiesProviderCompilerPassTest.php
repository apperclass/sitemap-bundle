<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\DependencyInjection\Compiler;

use Apperclass\Bundle\SitemapBundle\DependencyInjection\Compiler\SitemapEntitiesProviderCompilerPass;

class SitemapEntitiesProviderCompilerPassTest extends CompilerPassTestCase
{
    /**
     * @var SitemapEntitiesProviderCompilerPass
     */
    private $compilerPass;

    protected function setUp()
    {
        parent::setUp();

        $this->compilerPass = new SitemapEntitiesProviderCompilerPass();
    }

    public function testProcessHasNoSitemapGeneratorDefinition()
    {
        $this->containerBuilderMock
             ->expects($this->exactly(1))
             ->method('hasDefinition')
             ->with('apperclass_sitemap.sitemap_generator')
             ->willReturn(false);

        $this->compilerPass->process($this->containerBuilderMock);
    }

    public function testProcess()
    {
        $taggedServices = array('foo'=> 'bar', 'john' => 'doe');

        $this->containerBuilderMock
            ->expects($this->exactly(1))
            ->method('hasDefinition')
            ->with('apperclass_sitemap.sitemap_generator')
            ->willReturn(true);

        $this->containerBuilderMock
            ->expects($this->exactly(1))
            ->method('findTaggedServiceIds')
            ->with('apperclass_sitemap.sitemap_entities_provider')
            ->willReturn($taggedServices);

        $definitionMock = $this->getDefinitionMock();

        $definitionMock
            ->expects($this->exactly(sizeof($taggedServices)))
            ->method('addMethodCall');

        $this->containerBuilderMock
            ->expects($this->exactly(1))
            ->method('getDefinition')
            ->with('apperclass_sitemap.sitemap_generator')
            ->willReturn($definitionMock);

        $this->compilerPass->process($this->containerBuilderMock);
    }

}