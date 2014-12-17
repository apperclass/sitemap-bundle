<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Provider;

use Apperclass\Bundle\SitemapBundle\Sitemap\Sitemap;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapImage;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapUrl;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapVideo;

class SitemapFactory
{

    public function getRandomSitemap()
    {
        $sitemap = new Sitemap();
        for ($urlCount = 0; $urlCount < rand(0,20); $urlCount++) {
            $sitemap->addSitemapUrl($this->getRandomSitemapUrl());
        }

        return $sitemap;
    }

    public function getRandomSitemapUrl()
    {
        $sitemapUrl = new SitemapUrl();
        $sitemapUrl->setLoc(sprintf('http://%s.com', uniqid()));

        if (rand(0,1)) {
            $sitemapUrl->setChangefreq('monthly');
        }

        if (rand(0,1)) {
            $sitemapUrl->setLastmod('2005-01-01');
        }

        if (rand(0,1)) {
            $sitemapUrl->setPriority("1");
        }

        $sitemapUrl->setImages($this->getRandomSitemapImages());
        $sitemapUrl->setVideos($this->getRandomSitemapVideos());

        return $sitemapUrl;
    }

    public function getRandomSitemapImages()
    {
        $images = array();
        for ($i=0; $i < rand(0,5); $i++) {
            $sitemapImage = new SitemapImage();
            $sitemapImage->setLoc(sprintf('http://website.com/%s.png', uniqid()));
            if (rand(0,1)) {
                $sitemapImage->setGeoLocation('Milan');
            }
            if (rand(0,1)) {
                $sitemapImage->setCaption('Caption Test');
            }
            if (rand(0,1)) {
                $sitemapImage->setTitle('Title Test');
            }
            if (rand(0,1)) {
                $sitemapImage->setLicense('License Test');
            }

            $images[] = $sitemapImage;
        }
        return $images;
    }

    public function getRandomSitemapVideos()
    {
        $videos = array();
        for ($i=0; $i < rand(0,5); $i++) {
            $sitemapVideo = new SitemapVideo();
            // @TODO add properties
            $videos[] = $sitemapVideo;
        }
        return $videos;
    }
}