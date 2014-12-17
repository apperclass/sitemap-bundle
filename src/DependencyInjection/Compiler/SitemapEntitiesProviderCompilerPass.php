<?php

namespace Apperclass\Bundle\SitemapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class SitemapEntitiesProviderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('apperclass_sitemap.sitemap_generator')) {
            return;
        }

        $definition = $container->getDefinition(
            'apperclass_sitemap.sitemap_generator'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'apperclass_sitemap.sitemap_entities_provider'
        );
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addSitemapEntitiesProvider',
                array(new Reference($id))
            );
        }
    }
}