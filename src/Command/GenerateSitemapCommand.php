<?php

namespace Apperclass\Bundle\SitemapBundle\Command;

use Apperclass\Bundle\SitemapBundle\Sitemap\Sitemap;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapGenerator;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapXmlEncoder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateSitemapCommand extends Command
{
    /** @var SitemapGenerator  */
    protected $sitemapGenerator;
    /** @var SitemapXmlEncoder */
    protected $sitemapXmlEncoder;
    /** @var string  */
    protected $webDir;

    /**
     * @param SitemapGenerator  $sitemapGenerator
     * @param SitemapXmlEncoder $sitemapXmlEncoder
     * @param string            $rootDir
     */
    public function __construct(SitemapGenerator $sitemapGenerator, SitemapXmlEncoder $sitemapXmlEncoder, $rootDir)
    {
        parent::__construct();
        $this->sitemapGenerator = $sitemapGenerator;
        $this->sitemapXmlEncoder = $sitemapXmlEncoder;
        $this->webDir = $rootDir . '/../web/';
    }


    /**
     * configure
     */
    protected function configure()
    {
        $this
            ->setName('apperclass:generate:sitemap')
            ->setDescription('Generate a sitemap')
            ->addOption('dump', null, InputOption::VALUE_NONE, 'If set dump the output to console')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<info>Start generating the sitemap</info>");

        $sitemap = $this->sitemapGenerator->generateSitemap();
        $xml = $this->sitemapXmlEncoder->toXml($sitemap);

        if ($input->getOption('dump')) {
            $output->write($xml);
        } else {
            file_put_contents($this->webDir.'sitemap.xml', $xml);
            $output->writeln("<info>Sitemap Updated</info>");
        }

        $output->writeln("<info>Sitemap Generation Success</info>");
    }
}