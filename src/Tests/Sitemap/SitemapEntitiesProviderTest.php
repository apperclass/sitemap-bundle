<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Sitemap;

use Apperclass\Bundle\SitemapBundle\Sitemap\Sitemap;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapEntitiesProvider;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapGenerator;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapProvider;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapXmlEncoder;
use Apperclass\Bundle\SitemapBundle\Tests\Mock\EntitiesProviderMockFactory;
use Apperclass\Bundle\SitemapBundle\Tests\Mock\EntityManagerMockFactory;
use Apperclass\Bundle\SitemapBundle\Tests\Provider\SitemapFactory;

class SitemapEntitiesProviderTest extends \PHPUnit_Framework_TestCase
{

    public function testGetEntities()
    {
        $entityManagerMockFactory = new EntityManagerMockFactory($this);
        $sitemapEntitiesProvider = new SitemapEntitiesProvider($entityManagerMockFactory->getMock());
        $entities = $sitemapEntitiesProvider->getEntities();

        $this->assertTrue(is_array($entities), "Entities provider must return an array.");
    }


}