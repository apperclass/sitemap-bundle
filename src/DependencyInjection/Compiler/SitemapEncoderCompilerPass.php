<?php

namespace Apperclass\Bundle\SitemapBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class SitemapEncoderCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('apperclass_sitemap.sitemap_encoder_manager')) {
            return;
        }

        $definition = $container->getDefinition(
            'apperclass_sitemap.sitemap_encoder_manager'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'apperclass_sitemap.sitemap_encoder'
        );

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall(
                'addSitemapEncoder',
                array(new Reference($id))
            );
        }
    }
}