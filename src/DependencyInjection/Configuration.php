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
            ->children()
                ->scalarNode('default_search_engine')
                    ->defaultNull()
                ->end()
                ->scalarNode('submit_value')
                    ->defaultValue('&#128269;')
                ->end()
            ->end()
        ;

        return $treebuilder;
    }
}
