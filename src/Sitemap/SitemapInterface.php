<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;

interface SitemapInterface
{
    /**
     * @return SitemapUrl[]
     */
    public function getAll();

    /**
     * @param SitemapUrl $sitemapUrl
     * @return SitemapInterface
     */
    public function add(SitemapUrl $sitemapUrl);
}