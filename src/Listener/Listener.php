<?php
/**
 * @copyright (c) 2006-2017 Stickee Technology Limited
 */

namespace Stickee\Sentry\Listener;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Raven_Client;
use Throwable;

/**
 * Class Listener
 *
 * @package Stickee\Sentry\Listener
 */
class Listener
{
    /**
     * @var \Raven_Client $client
     */
    private $client;

    /**
     * ErrorListener constructor.
     *
     * @param \Raven_Client $client
     */
    public function __construct(Raven_Client $client)
    {
        $this->client = $client;
    }

    /**
     * __invoke
     *
     * @param \Throwable $error
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function __invoke(Throwable $error, ServerRequestInterface $request, ResponseInterface $response): void
    {
        /** @noinspection PhpParamsInspection */
        $this->client->captureException($error);
    }
}
