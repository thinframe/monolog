<?php

/**
 * src/LoggerFactory.php
 *
 * @copyright 2013 Sorin Badea <sorin.badea91@gmail.com>
 * @license   MIT license (see the license file in the root directory)
 */

namespace ThinFrame\Monolog;

use Monolog\Logger;
use Psr\Log\LoggerAwareTrait;
use ThinFrame\Applications\DependencyInjection\ContainerAwareTrait;
use ThinFrame\Applications\DependencyInjection\Extensions\ConfigurationAwareInterface;

/**
 * Class MonologConfigurator
 *
 * @package ThinFrame\Monolog
 * @since   0.1
 */
class LoggerFactory implements ConfigurationAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @var array
     */
    private $configuration;

    /**
     * Attach configuration
     *
     * @param array $configuration
     *
     */
    public function setConfiguration(array $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * Create a new logger instance
     *
     * @return Logger
     */
    public function createLogger()
    {
        $logger = new Logger('thinframe.logger');

        if (isset($this->configuration['handlers'])) {
            foreach ($this->configuration['handlers'] as $handler) {
                $logger->pushHandler($this->container->get($handler));
            }
        }

        return $logger;
    }
}
