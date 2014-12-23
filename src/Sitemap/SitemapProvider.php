<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;

/**
 * Class SitemapProvider
 * Generate a Sitemap cycling over all entities
 *
 * @package Apperclass\Bundle\SitemapBundle\Sitemap
 */
class SitemapProvider
{
    /** @var array */
    protected $sitemapUrlProviders;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->sitemapUrlProviders = array();
    }

    /**
     * @param SitemapUrlProviderInterface $sitemapUrlProvider
     */
    public function addSitemapUrlProvider(SitemapUrlProviderInterface $sitemapUrlProvider)
    {
        $this->sitemapUrlProviders[] = $sitemapUrlProvider;
    }


    /**
     * @return Sitemap
     */
    public function getSitemap()
    {
        $sitemap = new Sitemap();

        /** @var SitemapUrlProviderInterface $provider */
        foreach ($this->sitemapUrlProviders as $provider) {
            $provider->populate($sitemap);
        }

        return $sitemap;
    }
}