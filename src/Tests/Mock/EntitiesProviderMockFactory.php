<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Mock;

class EntitiesProviderMockFactory extends AbstractMockFactory
{

    public function getMock()
    {
        $mockBuilder = $this->test->getMockBuilder('Apperclass\Bundle\SitemapBundle\Sitemap\SitemapEntitiesProvider');

        $entitiesProviderMock = $mockBuilder
            ->disableOriginalConstructor()
            ->getMock();

        $entitiesProviderMock->method('getEntities')->willReturn(array());

        return $entitiesProviderMock;
    }
}