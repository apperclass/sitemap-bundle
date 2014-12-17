<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapXmlEncoder;
use Apperclass\Bundle\SitemapBundle\Tests\Provider\SitemapFactory;

class SitemapXmlEncoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider sitemapProvider
     */
    public function testToXml($sitemap)
    {
        $sitemapXmlEncoder = new SitemapXmlEncoder();
        $xml = $sitemapXmlEncoder->toXml($sitemap);
        $result = simplexml_load_string($xml);

        $this->assertTrue($result instanceof \SimpleXMLElement, sprintf('This is not a valid xml %s', $xml));
    }

    public function sitemapProvider()
    {
        $data = array();
        $provider = new SitemapFactory();
        for ($i = 0; $i < 3; $i++) {
            $data[$i] = array($provider->getRandomSitemap());
        }

        return $data;
    }

}