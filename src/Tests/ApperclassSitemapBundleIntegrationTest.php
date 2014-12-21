<?php

namespace Apperclass\Bundle\SitemapBundle\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @group integration
 */
class ApperclassSitemapBundleIntegrationTest extends WebTestCase
{
    protected static $serviceIds = array(
        'apperclass_sitemap.sitemap_generator',
        'apperclass_sitemap.sitemap_provider',
        'apperclass_sitemap.sitemap_xml_encoder',
        'apperclass_sitemap.sitemap_entities_provider',
        'apperclass_sitemap.sitemap_generate_command'
    );

    /**
     * @var \Symfony\Bundle\FrameworkBundle\Client
     */
    protected $client;

    public function setUp()
    {
        $this->client = self::createClient();
    }

    public function testThatAllBundlePublicServicesAreReachableTroughContainer()
    {
        foreach(self::$serviceIds as $serviceId) {
            $service = $this->client->getKernel()->getContainer()->get($serviceId);
            $this->assertNotNull($service);
        }
    }
} 