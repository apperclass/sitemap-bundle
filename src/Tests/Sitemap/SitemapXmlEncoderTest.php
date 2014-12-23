<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapProvider;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapXmlEncoder;
use Apperclass\Bundle\SitemapBundle\Tests\Fixtures\Application\TestableSitemapUrlProvider;

class SitemapXmlEncoderTest extends \PHPUnit_Framework_TestCase
{
    public function testToXml()
    {
        $sitemapXmlEncoder = new SitemapXmlEncoder();
        $sitemapProvider   = new SitemapProvider();
        $sitemapProvider->addSitemapUrlProvider(new TestableSitemapUrlProvider());
        $xml = $sitemapXmlEncoder->toXml($sitemapProvider->getSitemap());

        $result = simplexml_load_string($xml);
        $this->assertTrue($result instanceof \SimpleXMLElement, sprintf('This is not a valid xml %s', $xml));
    }
}