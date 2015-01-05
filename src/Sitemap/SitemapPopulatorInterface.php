<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapInterface;

interface SitemapPopulatorInterface
{
    /**
     * @param SitemapInterface $sitemap
     * @return void
     */
    public function populate(SitemapInterface $sitemap);

}