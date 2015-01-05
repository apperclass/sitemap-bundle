<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapBuilder;
use Apperclass\Bundle\SitemapBundle\Tests\Fixtures\SitemapPopulatorExample;


class SitemapGeneratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SitemapBuilder
     */
    protected $sitemapBuilder;

    public function setUp()
    {
        $this->sitemapBuilder = new SitemapBuilder();
        $this->sitemapBuilder->addSitemapPopulator(new SitemapPopulatorExample());
    }

    public function testGenerateSitemap()
    {
        $sitemap = $this
            ->sitemapBuilder
            ->build();

        $this->assertInstanceOf('Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapInterface', $sitemap);
    }

}
