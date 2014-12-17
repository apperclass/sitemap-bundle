<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Mock;

use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapUrl;

class SitemapUrlProviderMockFactory extends AbstractMockFactory
{

    public function getMock()
    {
        $sitemapUrlProviderMock = $this->test->getMock('Apperclass\Bundle\SitemapBundle\Sitemap\SitemapUrlProviderInterface');
        $sitemapUrlProviderMock->method('supportsObject')->willReturn(true);

        $sitemapUrl = new SitemapUrl();
        $sitemapUrl->setLoc('http://sampleurl.com');
        $sitemapUrlProviderMock->method('getSitemapUrl')->willReturn($sitemapUrl);

        return $sitemapUrlProviderMock;
    }
}