<?php

namespace Apperclass\Bundle\SitemapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class SitemapUrlProviderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('apperclass_sitemap.sitemap_provider')) {
            return;
        }

        $definition = $container->getDefinition(
            'apperclass_sitemap.sitemap_provider'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'apperclass_sitemap.sitemap_url_provider'
        );
        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addSitemapUrlProvider',
                array(new Reference($id))
            );
        }
    }
}