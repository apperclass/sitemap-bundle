<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Command;

use Apperclass\Bundle\SitemapBundle\Command\SitemapGenerateCommand;
use Apperclass\Bundle\SitemapBundle\Sitemap\Sitemap;
use Apperclass\Bundle\SitemapBundle\Tests\Filesystem\FilesystemTestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class GenerateSitemapCommandTest extends FilesystemTestCase
{
    protected $command;

    /**
     * @var CommandTester
     */
    protected $commandTester;

    protected $path;

    public function setUp()
    {
        parent::setUp();

        $this->path   = $this->workspace . '/sitemap.xml';

        $application = new Application();
        $application->add(new SitemapGenerateCommand(
            $this->getSitemapGeneratorMock(),
            $this->getSitemapXmlEncoderMock(),
            $this->path
        ));

        $this->commandTester = new CommandTester($application->find('apperclass:sitemap:generate'));
    }

    /**
     * @expectedException        \Symfony\Component\Filesystem\Exception\IOException
     * @expectedExceptionMessage Dir doesn't exists!
     */
    public function testIOExceptionDirDoesntExists()
    {
        $this->commandTester->execute(array('--path' => '/../foo/sitemap.xml' ));
    }

    /**
     * @expectedException        \Symfony\Component\Filesystem\Exception\IOException
     * @expectedExceptionMessage Path is a dir not an absolute path to the output file!
     */
    public function testIOExceptionPathIsADir()
    {
        $this->commandTester->execute(array('--path' => $this->workspace ));
    }

    public function testExecute()
    {
        $this->commandTester->execute(array());
        $this->assertFileExists($this->path);
    }

    public function testExecuteWithDumpOption()
    {
        $this->commandTester->execute(array('--dump' => true));
        $this->assertRegExp('/<xml><\/xml>/', $this->commandTester->getDisplay());
        $this->assertFileNotExists($this->path);
    }

    public function testExecuteWithPathOption()
    {
        $path = $this->workspace . '/foobar.xml';
        $this->commandTester->execute(array('--path' => $path));
        $this->assertFileExists($path);
    }

    protected  function getSitemapGeneratorMock()
    {
        $mock = $this->getMockBuilder('Apperclass\Bundle\SitemapBundle\Sitemap\SitemapGenerator')
            ->disableOriginalConstructor()
            ->getMock();

        $mock
            ->expects($this->any())
            ->method('generateSitemap')
            ->willReturn(new Sitemap());

        return $mock;
    }

    protected function getSitemapXmlEncoderMock()
    {
        $mock = $this->getMockBuilder('Apperclass\Bundle\SitemapBundle\Sitemap\SitemapXmlEncoder')
            ->disableOriginalConstructor()
            ->getMock();

        $mock
            ->expects($this->any())
            ->method('toXml')
            ->willReturn('<xml></xml>');

        return $mock;
    }

}