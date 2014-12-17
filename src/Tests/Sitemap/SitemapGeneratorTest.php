<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\Sitemap;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapGenerator;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapProvider;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapXmlEncoder;
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

    public function sitemapProvider()
    {
        $provider = new SitemapFactory();

        return array(array($provider->getRandomSitemap()));
    }

}