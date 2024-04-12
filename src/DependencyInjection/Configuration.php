<?php

namespace Websystems\StructureBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('structure');

        $treeBuilder->getRootNode()
            ->children()
                ->variableNode('widgets')->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
