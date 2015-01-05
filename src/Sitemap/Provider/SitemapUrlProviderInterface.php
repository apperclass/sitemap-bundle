<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap\Provider;
use Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapInterface;

interface SitemapUrlProviderInterface
{
    public function populate(SitemapInterface $sitemap);
}