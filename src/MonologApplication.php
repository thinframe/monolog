<?php

/**
 * src/MonologApplication.php
 *
 * @author    Sorin Badea <sorin.badea91@gmail.com>
 * @license   MIT license (see the license file in the root directory)
 */

namespace ThinFrame\Monolog;

use PhpCollection\Map;
use ThinFrame\Applications\AbstractApplication;
use ThinFrame\Applications\DependencyInjection\ContainerConfigurator;

/**
 * Class MonologApplication
 *
 * @package ThinFrame\Monolog
 * @since   0.1
 */
class MonologApplication extends AbstractApplication
{
    /**
     * Get application name
     *
     * @return string
     */
    public function getName()
    {
        return $this->reflector->getShortName();
    }

    /**
     * Get application parents
     *
     * @return AbstractApplication[]
     */
    public function getParents()
    {
        // noop
    }

    /**
     * Set different options for the container configurator
     *
     * @param ContainerConfigurator $configurator
     */
    protected function setConfiguration(ContainerConfigurator $configurator)
    {
        $configurator
            ->addResource('Resources/services/services.yml')
            ->addResource('Resources/services/config.yml')
            ->addExtension($hybridExtension = new MonologHybridExtension())
            ->addCompilerPass($hybridExtension);
    }

    /**
     * Set application metadata
     *
     * @param Map $metadata
     *
     */
    protected function setMetadata(Map $metadata)
    {
        // noop
    }
}
