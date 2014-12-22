<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;

/**
 * Class Sitemap
 * It's the object representation of a sitemap
 *
 * @package Apperclass\Bundle\SitemapBundle\Sitemap
 */
class Sitemap implements SitemapInterface
{
    /** @var SitemapUrl[] */
    protected $sitemapUrls;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->sitemapUrls = array();
    }

    /**
     * @param SitemapUrl $sitemapUrl
     */
    public function addSitemapUrl(SitemapUrl $sitemapUrl)
    {
        $this->sitemapUrls[] = $sitemapUrl;
    }

    /**
     * @return SitemapUrl[]
     */
    public function getSitemapUrls()
    {
        return $this->sitemapUrls;
    }

    public function add(SitemapUrl $sitemapUrl)
    {
        $this->sitemapUrls[] = $sitemapUrl;
        return $this;
    }
}