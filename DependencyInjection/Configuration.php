<?php

namespace Kpicaza\Bundle\MetricsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('kpicaza_metrics');

        $rootNode
            ->children()
                ->booleanNode('track_admins')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->defaultFalse()
                ->end()
                ->booleanNode('enable_blocks')
                    ->isRequired()
                    ->cannotBeEmpty()
                    ->defaultFalse()
                ->end()
                ->arrayNode('entities')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('class')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->scalarNode('view')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                        ->end()
                    ->end()
                ->end() 
            ->end()
        ;


        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        return $treeBuilder;
    }

}
