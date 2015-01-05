<?php

namespace Apperclass\Bundle\SitemapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class SitemapBuilderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('apperclass_sitemap.sitemap_builder')) {
            return;
        }

        $definition = $container->getDefinition(
            'apperclass_sitemap.sitemap_builder'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'apperclass_sitemap.sitemap_populator'
        );
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addSitemapPopulator',
                array(new Reference($id))
            );
        }
    }
}