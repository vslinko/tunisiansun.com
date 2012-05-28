<?php

namespace Rithis\StoreBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rithis_store');

        $rootNode
            ->children()
                ->scalarNode('filesystem_id')->defaultValue('gaufrette.rithis_store_filesystem')->end()
                ->scalarNode('asset_url_pattern')->isRequired()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
