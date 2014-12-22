<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;

/**
 * Class SitemapProvider
 * Generate a Sitemap cycling over all entities
 *
 * @package Apperclass\Bundle\SitemapBundle\Sitemap
 */
class SitemapProvider
{
    /** @var array */
    protected $sitemapUrlProviders;

    /**
     * __construct
     */
    public function __construct()
    {
        $this->sitemapUrlProviders = array();
    }

    /**
     * @param SitemapUrlProviderInterface $sitemapUrlProvider
     */
    public function addSitemapUrlProvider(SitemapUrlProviderInterface $sitemapUrlProvider)
    {
        $this->sitemapUrlProviders[] = $sitemapUrlProvider;
    }


    /**
     * @param array $objects
     *
     * @return Sitemap
     */
    public function getSitemap($objects = null)
    {
        $sitemap = new Sitemap();

        if($objects) {
            foreach ($objects as $object) {
                $sitemapUrl = $this->getSitemapUrl($object);
                if ($sitemapUrl) {
                    $sitemap->addSitemapUrl($sitemapUrl);
                }
            }
        }else{
            /** @var SitemapUrlProviderInterface $provider */
            foreach ($this->sitemapUrlProviders as $provider) {
                $provider->populate($sitemap);
            }
        }

        return $sitemap;
    }

    /**
     * @param mixed $object
     *
     * @return null|SitemapUrl
     */
    protected function getSitemapUrl($object)
    {
        /** @var SitemapUrlProviderInterface $provider */
        foreach ($this->sitemapUrlProviders as $provider) {
            if ($provider->supportsObject($object)) {
                return $provider->getSitemapUrl($object);
            }
        }

        return null;
    }


}