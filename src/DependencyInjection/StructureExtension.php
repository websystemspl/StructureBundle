<?php

namespace Websystems\StructureBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

/**
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 */
class StructureExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container): void
    {
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.php');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $container->setParameter('structure', $config);
    }
}
