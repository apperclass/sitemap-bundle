<?php

namespace Apperclass\Bundle\SitemapBundle\Sitemap\Encoder;

use Apperclass\Bundle\SitemapBundle\Sitemap\Model\SitemapInterface;

interface SitemapEncoderInterface
{
    /**
     * @param SitemapInterface $sitemap
     * @return string
     */
    public function encode(SitemapInterface $sitemap);

    /**
     * @return string
     */
    public function getFormat();
} 