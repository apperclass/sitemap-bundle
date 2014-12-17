<?php

namespace Apperclass\Bundle\SitemapBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('apperclass_sitemap');

//        $rootNode
//            ->children()
//                ->arrayNode('providers')
//                ->prototype('array')
//                    ->children()
//                        ->arrayNode()
//                            ->children()
//                                ->scalarNode('sitemap_provider')->end()
//                                ->scalarNode('entity_provider')->end()
//                                ->scalarNode('changefreq')->end()
//                                ->scalarNode('priority')->end()
//                            ->end()
//                        ->end()
//                    ->end()
//                ->end() // twitter
//            ->end()
//        ;

        return $treeBuilder;
    }
}
