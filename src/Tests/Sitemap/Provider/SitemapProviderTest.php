<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap\Provider;

use Apperclass\Bundle\SitemapBundle\Tests\Fixtures\SitemapUrlProviderExample;

class SitemapProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TestableSitemapProvider
     */
    protected $sitemapProvider;

    public function setUp()
    {
        $this->sitemapProvider = new TestableSitemapProvider();
    }

    public function testAddSitemapUrlProvider()
    {
        $sitemapUrlProvider = new SitemapUrlProviderExample();

        $this
            ->sitemapProvider
            ->addSitemapUrlProvider(new SitemapUrlProviderExample());

        $this->assertInstanceOf(get_class($sitemapUrlProvider), $this->sitemapProvider->getSitemapUrlProviders()[0]);
    }

    public function testGetSitemap()
    {
        $this
            ->sitemapProvider
            ->addSitemapUrlProvider(new SitemapUrlProviderExample());

        $sitemap = $this->sitemapProvider->getSitemap();
        
        $this->assertInstanceOf('Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapInterface', $sitemap );
        $this->assertCount(2, $sitemap->getSitemapUrls());
    }
}



