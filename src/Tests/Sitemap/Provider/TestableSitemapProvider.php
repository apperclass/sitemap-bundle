<?php


namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap\Provider;


use Apperclass\Bundle\SitemapBundle\Sitemap\Provider\SitemapProvider;

class TestableSitemapProvider extends SitemapProvider
{
    public function getSitemapUrlProviders()
    {
        return $this->sitemapUrlProviders;
    }
}