<?php

namespace Apperclass\Bundle\SitemapBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use Apperclass\Bundle\SitemapBundle\Sitemap\Encoder\SitemapEncoderManagerInterface;
use Apperclass\Bundle\SitemapBundle\Sitemap\SitemapGenerator;
use Apperclass\Bundle\SitemapBundle\Sitemap\Writer\SitemapFileWriter;

class SitemapGenerateCommand extends Command
{
    /** @var SitemapGenerator  */
    protected $sitemapGenerator;

    /** @var SitemapEncoderManagerInterface */
    protected $sitemapEncoderManager;

    /** @var string  */
    protected $path;

    /**
     * @var SitemapFileWriter
     */
    protected $writer;

    /**
     * @param SitemapGenerator $sitemapGenerator
     * @param SitemapEncoderManagerInterface $sitemapEncoderManager
     * @param SitemapFileWriter $writer
     * @param $path
     */
    public function __construct(SitemapGenerator $sitemapGenerator,
                                SitemapEncoderManagerInterface $sitemapEncoderManager,
                                SitemapFileWriter $writer,
                                $path)
    {
        $this->sitemapGenerator  = $sitemapGenerator;
        $this->sitemapEncoderManager  = $sitemapEncoderManager;
        $this->path   = $path;
        $this->writer = $writer;

        $this->writer->setPath($this->path);

        parent::__construct();
    }


    /**
     * configure
     */
    protected function configure()
    {
        $this
            ->setName('apperclass:sitemap:generate')
            ->setDescription('Generate a sitemap')
            ->addOption('path', null, InputOption::VALUE_OPTIONAL, 'Change the default output file path', $this->path)
            ->addOption('format', null, InputOption::VALUE_OPTIONAL, 'Sets the output format <info>['. implode('|',$this->sitemapEncoderManager->getFormats()) .']</info>', 'xml')
            ->addOption('dump', null, InputOption::VALUE_NONE, 'Dump the output to console instead of writing to a file')
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
        $format = $input->getOption('format');
        $dump   = $input->getOption('dump');
        $path   = $input->getOption('path');

        $sitemap = $this->sitemapGenerator->generateSitemap();
        $string  = $this->sitemapEncoderManager->encode($sitemap, $format);

        if($dump) {
            return $this->executeDump($output, $string);
        }

        return $this->executeWrite($output, $path, $string);
    }

    protected function executeDump(OutputInterface $output, $string)
    {
        $output->writeln($string);
        return;
    }

    protected function executeWrite(OutputInterface $output, $path, $string)
    {

        if (!$this->getHelper('dialog')->askConfirmation(
            $output,
            "<question>This operation could overwrite existing files, continue with this action (y/N)?</question> ",
            false
        )) {
            $output->writeln("<info>aborted.</info>");
            return;
        }

        $this
            ->writer
            ->setPath($path)
            ->write($string);

        $output->writeln("<info>file '" . realpath($path) ."' was updated.</info>");

        return;
    }
}