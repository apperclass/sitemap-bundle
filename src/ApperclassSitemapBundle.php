<?php

namespace Apperclass\Bundle\SitemapBundle;

use Apperclass\Bundle\SitemapBundle\DependencyInjection\Compiler\SitemapBuilderCompilerPass;
use Apperclass\Bundle\SitemapBundle\DependencyInjection\Compiler\SitemapEncoderCompilerPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ApperclassSitemapBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new SitemapBuilderCompilerPass());
        $container->addCompilerPass(new SitemapEncoderCompilerPass());
    }
}
