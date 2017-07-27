<?php
/**
 * @copyright (c) 2006-2017 Stickee Technology Limited
 */

namespace Stickee\Sentry;

use Interop\Container\ContainerInterface;
use Stickee\Sentry\Listener\Listener;
use Zend\ServiceManager\Factory\DelegatorFactoryInterface;

class ListenerDelegator implements DelegatorFactoryInterface
{
    /**
     * A factory that creates delegates of a given service
     *
     * @param  ContainerInterface $container
     * @param  string $name
     * @param  callable $callback
     * @param  null|array $options
     *
     * @return \Zend\Stratigility\Middleware\ErrorHandler
     *
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $name, callable $callback, array $options = null)
    {
        $listener = $container->get(Listener::class);

        /** @var \Zend\Stratigility\Middleware\ErrorHandler $errorHandler */
        $errorHandler = $callback();

        $errorHandler->attachListener($listener);

        return $errorHandler;
    }
}
