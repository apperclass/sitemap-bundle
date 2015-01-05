<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapGenerator;
use Apperclass\Bundle\SitemapBundle\Tests\Fixtures\SitemapUrlProviderExample;
use Apperclass\Bundle\SitemapBundle\Tests\Sitemap\Provider\TestableSitemapProvider;

class SitemapGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SitemapGenerator
     */
    protected $sitemapGenerator;

    public function setUp()
    {
        $sitemapProvider = new TestableSitemapProvider();
        $sitemapProvider->addSitemapUrlProvider(new SitemapUrlProviderExample());

        $this->sitemapGenerator = new SitemapGenerator($sitemapProvider);
    }

    public function testGenerateSitemap()
    {
        $sitemap = $this
            ->sitemapGenerator
            ->generateSitemap();

        $this->assertInstanceOf('Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapInterface', $sitemap);
    }

}
