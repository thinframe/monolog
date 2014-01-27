<?php

/**
 * src/MonologApplication.php
 *
 * @copyright 2013 Sorin Badea <sorin.badea91@gmail.com>
 * @license   MIT license (see the license file in the root directory)
 */

namespace ThinFrame\Monolog;

use ThinFrame\Applications\AbstractApplication;
use ThinFrame\Applications\DependencyInjection\AwareDefinition;
use ThinFrame\Applications\DependencyInjection\ContainerConfigurator;
use ThinFrame\Applications\DependencyInjection\Extensions\ConfigurationManager;

/**
 * Class MonologApplication
 *
 * @package ThinFrame\Monolog
 * @since   0.1
 */
class MonologApplication extends AbstractApplication
{
    /**
     * Get parent applications
     *
     * @return AbstractApplication[]
     */
    protected function getParentApplications()
    {
        return [];
    }

    /**
     * initialize configurator
     *
     * @param ContainerConfigurator $configurator
     *
     * @return mixed
     */
    public function initializeConfigurator(ContainerConfigurator $configurator)
    {
        $configurator->addAwareDefinition(
            new AwareDefinition('\Psr\Log\LoggerAwareTrait', 'setLogger', 'thinframe.logger')
        );
        $configurator->addConfigurationManager(
            new ConfigurationManager('thinframe.logger', 'thinframe.logger.factory')
        );
    }

    /**
     * Get configuration files
     *
     * @return mixed
     */
    public function getConfigurationFiles()
    {
        return [
            'resources/services.yml'
        ];
    }

    /**
     * Get application name
     *
     * @return string
     */
    public function getApplicationName()
    {
        return 'MonologApplication';
    }
}
