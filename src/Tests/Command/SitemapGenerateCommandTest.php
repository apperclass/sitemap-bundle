<?php

namespace Apperclass\Bundle\SitemapBundle\Tests\Command;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Apperclass\Bundle\SitemapBundle\Command\SitemapGenerateCommand;
use Apperclass\SitemapBuilder\Writer\SitemapFileWriter;
use Apperclass\SitemapBuilder\Model\Sitemap;
use Apperclass\SitemapBuilder\Tests\Filesystem\FilesystemTestCase;


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

        $this->commandTester = $this->getCommandTester();
    }

    public function testExecute()
    {
        $this->commandTester->execute(array());
        $this->assertFileExists($this->path);
    }

    public function testExecuteAbortedAfterAskConfirmation()
    {
        $commandTester = $this->getCommandTester(false);
        $commandTester->execute(array());
        $this->assertRegExp('/aborted/i', $commandTester->getDisplay());
        $this->assertFileNotExists($this->path);
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

    protected function getCommandTester($dialogConfirmation = true)
    {
        $application = new Application();
        $application->add(new SitemapGenerateCommand(
            $this->getSitemapBuilderMock(),
            $this->getSitemapEncoderManagerMock(),
            (new SitemapFileWriter()),
            $this->path
        ));

        $dialog = $this->getMock('Symfony\Component\Console\Helper\DialogHelper', array('askConfirmation'));
        $dialog->expects($this->any())
            ->method('askConfirmation')
            ->will($this->returnValue($dialogConfirmation)); // The user confirms

        // We override the standard helper with our mock
        $command = $application->find('apperclass:sitemap:generate');
        $command->getHelperSet()->set($dialog, 'dialog');

        return new CommandTester($command);
    }

    protected  function getSitemapBuilderMock()
    {
        $mock = $this->getMockBuilder('Apperclass\SitemapBuilder\SitemapBuilderInterface')
            ->disableOriginalConstructor()
            ->getMock();

        $mock
            ->expects($this->any())
            ->method('build')
            ->willReturn(new Sitemap());

        return $mock;
    }

    protected function getSitemapEncoderManagerMock()
    {
        $mock = $this->getMockBuilder('Apperclass\SitemapBuilder\Encoder\SitemapEncoderManager')
            ->disableOriginalConstructor()
            ->getMock();

        $mock
            ->expects($this->any())
            ->method('encode')
            ->willReturn('<xml></xml>');

        $mock
            ->expects($this->any())
            ->method('getFormats')
            ->willReturn(array('xml'));

        $mock
            ->expects($this->any())
            ->method('supportsFormat')
            ->willReturn(true);

        return $mock;
    }

}