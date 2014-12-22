<?php


namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\Sitemap;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapGenerator;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapInterface;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapProvider;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapUrl;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapUrlProviderInterface;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapXmlEncoder;
use Apperclass\Bundle\SitemapBundle\Tests\Fixtures\Application\TestableSitemapUrlProvider;
use Apperclass\Bundle\SitemapBundle\Tests\Mock\EntitiesProviderMockFactory;
use Apperclass\Bundle\SitemapBundle\Tests\Provider\SitemapFactory;


class SitemapGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider sitemapProvider
     */
    public function testGenerateSitemap($sitemap)
    {
        $entitiesMockFactory = new EntitiesProviderMockFactory($this);
        $sitemapGenerator = new SitemapGenerator(new SitemapProvider());
        $sitemapGenerator->addSitemapEntitiesProvider($entitiesMockFactory->getMock());
        $sitemap = $sitemapGenerator->generateSitemap($sitemap);
        $this->assertTrue($sitemap instanceof Sitemap, "Generated sitemap is not instance of Sitemap");
    }

    public function testGenerateSitemapWithoutEntitiesAndWithNewInterface()
    {
        $sitemapProvider  = new SitemapProvider();
        $sitemapProvider->addSitemapUrlProvider(new TestableSitemapUrlProvider());
        $sitemapGenerator = new SitemapGenerator($sitemapProvider);

        $sitemap = $sitemapGenerator->generateSitemap();
        $this->assertTrue($sitemap instanceof Sitemap, "Generated sitemap is not instance of Sitemap");

        $sitemapUrls = $sitemap->getSitemapUrls();
        $this->assertInternalType('array',$sitemapUrls);
        $this->assertEquals(2, count($sitemapUrls));
    }

    public function sitemapProvider()
    {
        $provider = new SitemapFactory();

        return array(array($provider->getRandomSitemap()));
    }
}

