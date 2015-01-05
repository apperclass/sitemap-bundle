<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;
use Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapInterface;
use Apperclass\Bundle\SitemapBundle\Sitemap\Provider\SitemapProvider;

class SitemapGenerator
{
    /** @var SitemapProvider  */
    protected $sitemapProvider;

    public function __construct(SitemapProvider $sitemapProvider)
    {
        $this->sitemapProvider = $sitemapProvider;
    }

    /**
     * @return SitemapInterface
     */
    public function generateSitemap()
    {
        return $this->sitemapProvider->getSitemap();
    }
}
