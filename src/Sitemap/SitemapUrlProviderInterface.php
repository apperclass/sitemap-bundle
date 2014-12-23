<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;

/**
 * Interface SitemapUrlProviderInterface
 * Interface you should implement to parse an object and give back a Sitemap Url
 *
 * @package Apperclass\Bundle\SitemapBundle\Sitemap
 */
interface SitemapUrlProviderInterface
{

    /**
     * @param mixed $object
     *
     * @return bool
     */
    public function supportsObject($object);

    /**
     * @param mixed $object
     *
     * @return SitemapUrl
     */
    public function getSitemapUrl($object);

    /**
     * @param SitemapInterface $sitemap
     * @return void
     */
    public function populate(SitemapInterface $sitemap);
}