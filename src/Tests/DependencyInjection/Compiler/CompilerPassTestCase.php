<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\DependencyInjection\Compiler;


use PHPUnit_Framework_MockObject_MockObject;

abstract class CompilerPassTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    protected $containerBuilderMock;

    protected function setUp()
    {
        $this->containerBuilderMock = $this->getContainerBuilderMock();
    }

    protected function getContainerBuilderMock()
    {
        $mock = $this->getMockBuilder('Symfony\Component\DependencyInjection\ContainerBuilder')
            ->disableOriginalConstructor()
            ->getMock();

        return $mock;
    }

    protected function getDefinitionMock()
    {
        $mock = $this->getMockBuilder('Symfony\Component\DependencyInjection\Definition')
            ->disableOriginalConstructor()
            ->getMock();

        return $mock;
    }
} 