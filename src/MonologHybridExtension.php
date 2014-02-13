<?php

/**
 * src/MonologHybridExtension.php
 *
 * @author    Sorin Badea <sorin.badea91@gmail.com>
 * @license   MIT license (see the license file in the root directory)
 */

namespace ThinFrame\Monolog;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class MonologHybridExtension
 *
 * @package ThinFrame\Monolog
 * @since   0.1
 */
class MonologHybridExtension implements ExtensionInterface, CompilerPassInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     *
     * @api
     */
    public function process(ContainerBuilder $container)
    {
        $loggerServiceDefinition = $container->getDefinition($this->config['logger_service']);
        $loggerServiceDefinition->setArguments([$this->config['logger_name']]);
        foreach ($this->config['handlers'] as $handler) {
            $loggerServiceDefinition->addMethodCall('pushHandler', [new Reference($handler['service'])]);
        }
    }


    /**
     * Loads a specific configuration.
     *
     * @param array            $config    An array of configuration values
     * @param ContainerBuilder $container A ContainerBuilder instance
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     *
     * @api
     */
    public function load(array $config, ContainerBuilder $container)
    {
        $processor    = new Processor();
        $this->config = $processor->processConfiguration(new MonologConfiguration(), $config);

    }

    /**
     * Returns the namespace to be used for this extension (XML namespace).
     *
     * @return string The XML namespace
     *
     * @api
     */
    public function getNamespace()
    {
        return '';
    }

    /**
     * Returns the base path for the XSD files.
     *
     * @return string The XSD base path
     *
     * @api
     */
    public function getXsdValidationBasePath()
    {
        return '';
    }

    /**
     * Returns the recommended alias to use in XML.
     *
     * This alias is also the mandatory prefix to use when using YAML.
     *
     * @return string The alias
     *
     * @api
     */
    public function getAlias()
    {
        return 'monolog';
    }
}
