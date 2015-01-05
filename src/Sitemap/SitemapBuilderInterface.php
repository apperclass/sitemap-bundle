<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapInterface;

interface SitemapBuilderInterface
{
    /**
     * @return SitemapInterface
     */
    public function build();

    /**
     * @param SitemapPopulatorInterface $sitemapPopulator
     * @return void
     */
    public function addSitemapPopulator(SitemapPopulatorInterface $sitemapPopulator);

}