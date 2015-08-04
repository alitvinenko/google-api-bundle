<?php

namespace Alitvinenko\GoogleApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $root = $treeBuilder->root('alitvinenko_google_api');

        $root
            ->children()
            ->scalarNode('key')->isRequired()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}