<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;

/**
 * Class SitemapGenerator
 * It loads all entities and generates the sitemap.
 *
 * @package Apperclass\Bundle\SitemapBundle\Sitemap
 */
class SitemapGenerator
{
    /** @var array */
    protected $sitemapEntitiesProviders;
    /** @var SitemapProvider  */
    protected $sitemapProvider;

    /**
     * __construct
     */
    public function __construct(SitemapProvider $sitemapProvider)
    {
        $this->sitemapEntitiesProviders = array();
        $this->sitemapProvider = $sitemapProvider;
    }

    /**
     * @param SitemapEntitiesProviderInterface $sitemapEntitiesProvider
     */
    public function addSitemapEntitiesProvider(SitemapEntitiesProviderInterface $sitemapEntitiesProvider)
    {
        $this->sitemapEntitiesProviders[] = $sitemapEntitiesProvider;
    }

    /**
     * @return Sitemap
     */
    public function generateSitemap()
    {
        if(sizeof($this->sitemapEntitiesProviders) > 0) {
            $entities = array();
            /** @var SitemapEntitiesProviderInterface $provider */
            foreach ($this->sitemapEntitiesProviders as $provider) {
                $entities = array_merge($entities, $provider->getEntities());
            }

            return $this->sitemapProvider->getSitemap($entities);

        }else{

            return $this->sitemapProvider->getSitemap();
        }
    }


}
