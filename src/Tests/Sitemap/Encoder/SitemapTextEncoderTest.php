<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\Encoder\SitemapTextEncoder;
use Apperclass\Bundle\SitemapBundle\Tests\DataProvider\SitemapFactory;

class SitemapTextEncoderTest extends \PHPUnit_Framework_TestCase
{
    public function testEncode()
    {
        $sitemap    = SitemapFactory::createSitemap();
        $google     = SitemapFactory::createSitemapUrl();
        $apperclass = SitemapFactory::createSitemapUrl();

        $google->setLoc('http://www.google.it');
        $apperclass->setLoc('http://www.apperclass.com');

        $sitemap->addSitemapUrl($google);
        $sitemap->addSitemapUrl($apperclass);


        $sitemapTextEncoder = new SitemapTextEncoder();
        $string = $sitemapTextEncoder->encode($sitemap);

        $expected = "http://www.google.it\nhttp://www.apperclass.com";
        $this->assertEquals($expected, $string);
    }
}