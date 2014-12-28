<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap\Encoder;

use Apperclass\Bundle\SitemapBundle\Sitemap\Encoder\SitemapXmlEncoder;
use Apperclass\Bundle\SitemapBundle\Tests\DataProvider\SitemapFactory;

class SitemapXmlEncoderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider sitemapProvider
     */
    public function testEncode($sitemap)
    {
        $sitemapXmlEncoder = new SitemapXmlEncoder();
        $xml = $sitemapXmlEncoder->encode($sitemap);
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