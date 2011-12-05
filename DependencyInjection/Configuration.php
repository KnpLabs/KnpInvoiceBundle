<?php

namespace Knp\Bundle\InvoiceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('knp_invoice');

        $rootNode
            ->children()
                ->scalarNode('generator')->defaultValue('%knp_invoice.generator.twig.class%')->end()
                ->arrayNode('theme')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('path')->defaultValue('%knp_invoice.theme.path%')->end()
                        ->scalarNode('template')->defaultValue('%knp_invoice.theme.template%')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}