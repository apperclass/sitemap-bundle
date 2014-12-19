<?php

namespace Apperclass\Bundle\SitemapBundle\Command;

use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapGenerator;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapXmlEncoder;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Exception\IOException;

class SitemapGenerateCommand extends Command
{
    /** @var SitemapGenerator  */
    protected $sitemapGenerator;
    /** @var SitemapXmlEncoder */
    protected $sitemapXmlEncoder;
    /** @var string  */
    protected $path;

    /**
     * @param SitemapGenerator $sitemapGenerator
     * @param SitemapXmlEncoder $sitemapXmlEncoder
     * @param string $path
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     */
    public function __construct(SitemapGenerator $sitemapGenerator, SitemapXmlEncoder $sitemapXmlEncoder, $path)
    {
        parent::__construct();

        $this->sitemapGenerator = $sitemapGenerator;
        $this->sitemapXmlEncoder = $sitemapXmlEncoder;
        $this->path = $path;

        $this->checkPath($path);
    }


    /**
     * configure
     */
    protected function configure()
    {
        $this
            ->setName('apperclass:sitemap:generate')
            ->setDescription('Generate a sitemap')
            ->addOption('dump', null, InputOption::VALUE_NONE, 'If set dump the output to console')
            ->addOption('path', null, InputOption::VALUE_OPTIONAL,
                'If set change the default output path')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @throws \Symfony\Component\Filesystem\Exception\IOException
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<info>Start generating the sitemap..</info>");

        $sitemap = $this->sitemapGenerator->generateSitemap();
        $xml     = $this->sitemapXmlEncoder->toXml($sitemap);

        $output->writeln("<info>Sitemap generation success</info>");

        if ($input->getOption('dump')) {

            $output->writeln("");
            $output->write($xml);

        } else {

            $path = $input->getOption('path') ? $input->getOption('path') : $this->path;
            $this->checkPath($path);

            file_put_contents($path, $xml);

            $output->writeln("<info>Sitemap file was updated</info>");
        }
    }

    protected function checkPath($path)
    {
        // check dir exists
        if(!realpath(dirname($path))) {
            throw new IOException("Dir doesn't exists!");
        }

        // check if the path is not a dir
        if(is_dir($path)) {
            throw new IOException("Path is a dir not an absolute path to the output file!");
        }
    }
}