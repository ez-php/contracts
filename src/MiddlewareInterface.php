<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

use EzPhp\Http\RequestInterface;
use EzPhp\Http\ResponseInterface;

/**
 * Interface MiddlewareInterface
 *
 * Contract for HTTP middleware. Each middleware receives the incoming request
 * and a callable for the next handler in the pipeline.
 *
 * @package EzPhp\Contracts
 */
interface MiddlewareInterface
{
    /**
     * Handle the incoming request and return a response.
     *
     * @param RequestInterface $request
     * @param callable         $next
     *
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request, callable $next): ResponseInterface;
}
