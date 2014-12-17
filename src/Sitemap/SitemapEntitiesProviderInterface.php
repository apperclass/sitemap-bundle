<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;

/**
 * Interface SitemapEntitiesProviderInterface
 * You should implements this interface to load all entities to generate your sitemap
 *
 * @package Apperclass\Bundle\SitemapBundle\Sitemap
 */
interface SitemapEntitiesProviderInterface
{
    /**
     * @return array
     */
    public function getEntities();
}