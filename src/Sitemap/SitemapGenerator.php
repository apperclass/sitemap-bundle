<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;

/**
 * Class SitemapGenerator
 * It loads all entities and generates the sitemap.
 *
 * @package Apperclass\Bundle\SitemapBundle\Sitemap
 */
class SitemapGenerator
{
    /** @var array */
    protected $sitemapEntitiesProviders;
    /** @var SitemapProvider  */
    protected $sitemapProvider;

    /**
     * __construct
     */
    public function __construct(SitemapProvider $sitemapProvider)
    {
        $this->sitemapEntitiesProviders = array();
        $this->sitemapProvider = $sitemapProvider;
    }


    /**
     * @return Sitemap
     */
    public function generateSitemap()
    {
        return $this->sitemapProvider->getSitemap();
    }

}
