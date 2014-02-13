<?php

/**
 * src/MonologConfiguration.php
 *
 * @author    Sorin Badea <sorin.badea91@gmail.com>
 * @license   MIT license (see the license file in the root directory)
 */

namespace ThinFrame\Monolog;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class MonologConfiguration
 *
 * @package ThinFrame\Monolog
 * @since   0.1
 */
class MonologConfiguration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        $rootNode = $treeBuilder->root('monolog');

        $rootNode
            ->children()
            ->scalarNode('logger_name')->isRequired()->end()
            ->scalarNode('logger_service')->isRequired()->end()
            ->arrayNode('handlers')->isRequired()
            ->prototype('array')->children()
            ->scalarNode('service')->isRequired()->end()
            ->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
