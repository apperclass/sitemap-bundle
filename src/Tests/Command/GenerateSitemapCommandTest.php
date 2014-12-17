<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Command;

use Apperclass\Bundle\SitemapBundle\Command\GenerateSitemapCommand;
use Apperclass\Bundle\SitemapBundle\Sitemap\Sitemap;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GenerateSitemapCommandTest extends \PHPUnit_Framework_TestCase
{
    protected $mockKernel;
    protected $mockSitemapGenerator;
    protected $mockSitemapXmlEncoder;

    public function testExecute()
    {
        $this->mockSitemapGenerator = $this->getMockSitemapGenerator();
        $this->mockSitemapXmlEncoder = $this->getMockSitemapXmlEncoder();

        $application = new Application();
        $application->add(new GenerateSitemapCommand($this->mockSitemapGenerator, $this->mockSitemapXmlEncoder, 'root'));

        $command = $application->find('apperclass:generate:sitemap');


        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName(), '--dump' => true));

        $this->assertRegExp('/Sitemap Generation Success/', $commandTester->getDisplay());
    }

    public function getMockSitemapGenerator()
    {
        $kernelMock = $this->getMockBuilder('Apperclass\Bundle\SitemapBundle\Sitemap\SitemapGenerator')
            ->disableOriginalConstructor()
            ->getMock();

        $kernelMock
            ->expects($this->any())
            ->method('generateSitemap')
            ->willReturn(new Sitemap());

        return $kernelMock;
    }

    public function getMockSitemapXmlEncoder()
    {
        $kernelMock = $this->getMockBuilder('Apperclass\Bundle\SitemapBundle\Sitemap\SitemapXmlEncoder')
            ->disableOriginalConstructor()
            ->getMock();

        $kernelMock
            ->expects($this->any())
            ->method('toXml')
            ->willReturn('<xml></xml>');

        return $kernelMock;
    }

    public function getCallback($service)
    {
        $map = array(
            'kernel' => $this->mockKernel,
            'apperclass_sitemap.sitemap_generator' => $this->mockSitemapGenerator,
            'apperclass_sitemap.sitemap_xml_encoder' =>  $this->mockSitemapXmlEncoder
        );

        return $map[$service];
    }

}