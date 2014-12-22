<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;

interface SitemapInterface
{
    public function add(SitemapUrl $sitemapUrl);
}