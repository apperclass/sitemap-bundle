<?php


namespace Apperclass\Bundle\SitemapBundle\Tests\Fixtures;

use Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapInterface;
use Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapUrl;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapPopulatorInterface;

class SitemapPopulatorExample implements  SitemapPopulatorInterface
{
    public function populate(SitemapInterface $sitemap)
    {
        $url = new SitemapUrl();
        $url->setLoc('http://www.google.it');

        $url2 = new SitemapUrl();
        $url2->setLoc('http://www.apperclass.com');

        $sitemap->addSitemapUrl($url);
        $sitemap->addSitemapUrl($url2);
    }
}