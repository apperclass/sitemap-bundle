<?php

namespace Apperclass\Bundle\SitemapBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApperclassSitemapBundleIntegrationTest extends WebTestCase
{
    protected static $serviceIds = array(
        'apperclass_sitemap.sitemap_builder',
        'apperclass_sitemap.sitemap_xml_encoder',
        'apperclass_sitemap.sitemap_text_encoder',
        'apperclass_sitemap.sitemap_encoder_manager',
        'apperclass_sitemap.sitemap_file_writer',
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