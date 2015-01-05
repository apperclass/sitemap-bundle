<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap\Model;

interface SitemapInterface
{
    /**
     * @param SitemapUrlInterface $sitemapUrl
     */
    public function addSitemapUrl(SitemapUrlInterface $sitemapUrl);

    /**
     * @return SitemapUrlInterface[]
     */
    public function getSitemapUrls();
} 