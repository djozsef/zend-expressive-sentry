<?php
/**
 * @copyright (c) 2006-2017 Stickee Technology Limited
 */

namespace Stickee\Sentry;

use Raven_Client;
use Stickee\Sentry\Listener\Listener;
use Stickee\Sentry\Listener\ListenerFactory;
use Stickee\Sentry\Raven\RavenFactory;
use Zend\Stratigility\Middleware\ErrorHandler;

/**
 * Class ConfigProvider
 *
 * @package Stickee\Sentry
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * getDependencies
     *
     * @return array
     */
    private function getDependencies(): array
    {
        return [
            'factories' => [
                Raven_Client::class => RavenFactory::class,
                Listener::class => ListenerFactory::class,
            ],
            'delegators' => [
                ErrorHandler::class => [
                    ListenerDelegator::class,
                ],
            ],

        ];
    }
}
