<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap\Provider;

use Apperclass\Bundle\SitemapBundle\Sitemap\Model\Sitemap;

class SitemapProvider
{
    /** @var SitemapUrlProviderInterface[] */
    protected $sitemapUrlProviders;

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

        foreach ($this->sitemapUrlProviders as $provider) {
            $provider->populate($sitemap);
        }

        return $sitemap;
    }
}