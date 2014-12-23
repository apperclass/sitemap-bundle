<?php


namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\Sitemap;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapGenerator;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapProvider;
use Apperclass\Bundle\SitemapBundle\Tests\Fixtures\Application\TestableSitemapUrlProvider;


class SitemapGeneratorTest extends \PHPUnit_Framework_TestCase
{


    public function testGenerateSitemap()
    {
        $sitemapProvider  = new SitemapProvider();
        $sitemapProvider->addSitemapUrlProvider(new TestableSitemapUrlProvider());
        $sitemapGenerator = new SitemapGenerator($sitemapProvider);

        $sitemap = $sitemapGenerator->generateSitemap();
        $this->assertTrue($sitemap instanceof Sitemap, "Generated sitemap is not instance of Sitemap");

        $sitemapUrls = $sitemap->getAll();
        $this->assertInternalType('array',$sitemapUrls);
        $this->assertEquals(2, count($sitemapUrls));
    }
}

