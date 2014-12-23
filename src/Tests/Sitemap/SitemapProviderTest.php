<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\Sitemap;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapProvider;
use Apperclass\Bundle\SitemapBundle\Tests\Fixtures\Application\TestableSitemapUrlProvider;

class SitemapProviderTest extends \PHPUnit_Framework_TestCase
{

    public function testGetSitemap()
    {
        $sitemapProvider = new SitemapProvider();

        $sitemap = $sitemapProvider->getSitemap();
        $this->assertTrue($sitemap instanceof Sitemap, "Provided sitemap must be instance of Sitemap");

        $sitemapProvider  = new SitemapProvider();
        $sitemapProvider->addSitemapUrlProvider(new TestableSitemapUrlProvider());
        $sitemap = $sitemapProvider->getSitemap();

        $this->assertTrue($sitemap instanceof Sitemap, "Provided sitemap must be instance of Sitemap");
        $sitemapUrls = $sitemap->getAll();
        $this->assertInternalType('array',$sitemapUrls);
        $this->assertEquals(2, count($sitemapUrls));
    }
}