<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\Sitemap;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapGenerator;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapProvider;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapXmlEncoder;
use Apperclass\Bundle\SitemapBundle\Tests\Mock\EntitiesProviderMockFactory;
use Apperclass\Bundle\SitemapBundle\Tests\Mock\SitemapUrlProviderMockFactory;
use Apperclass\Bundle\SitemapBundle\Tests\Provider\SitemapFactory;

class SitemapProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider objectsProvider
     */
    public function testGetSitemap($objects)
    {
        $sitemapProvider = new SitemapProvider();

        $sitemap = $sitemapProvider->getSitemap($objects);
        $this->assertTrue($sitemap instanceof Sitemap, "Provided sitemap must be instance of Sitemap");

        $sitemapUrlProviderMockFactory = new SitemapUrlProviderMockFactory($this);
        $sitemapUrlProviderMock = $sitemapUrlProviderMockFactory->getMock();
        $sitemapProvider->addSitemapUrlProvider($sitemapUrlProviderMock);
        $sitemap = $sitemapProvider->getSitemap($objects);

        $this->assertTrue($sitemap instanceof Sitemap, "Provided sitemap must be instance of Sitemap");
    }

    public function objectsProvider()
    {
        $objects = array(new \stdClass(), new \stdClass());

        return array(array($objects));
    }

}