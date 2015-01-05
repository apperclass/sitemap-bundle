<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap\Encoder;

use Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapInterface;
use Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapUrlInterface;

class SitemapTextEncoder implements SitemapEncoderInterface
{
    protected static $lineBreak = "\n";

    public function encode(SitemapInterface $sitemap)
    {
        return implode(self::$lineBreak, array_map(function (SitemapUrlInterface $sitemapUrl) {
            return $sitemapUrl->getLoc();
        }, $sitemap->getSitemapUrls()));
    }

    public function getFormat()
    {
        return 'txt';
    }
}