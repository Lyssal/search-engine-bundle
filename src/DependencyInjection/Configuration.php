<?php
/**
 * This file is part of a Lyssal project.
 *
 * @copyright Rémi Leclerc
 * @author Rémi Leclerc
 */
namespace Lyssal\SearchEngineBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @inheritDoc
 */
class Configuration implements ConfigurationInterface
{
    /**
     * @inheritDoc
     */
    public function getConfigTreeBuilder()
    {
        $treebuilder = new TreeBuilder();
        $rootNode = $treebuilder->root('lyssal_search_engine');

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->arrayNode('search_engine')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('default')
                            ->defaultNull()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('host')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('search_on_host')
                            ->defaultTrue()
                        ->end()
                        ->scalarNode('default')
                            ->defaultNull()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('templating')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('form_template')
                            ->defaultValue('default')
                        ->end()
                        ->scalarNode('submit_value')
                            ->defaultValue('&#128269;')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treebuilder;
    }
}
