<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

use EzPhp\Http\RequestInterface;
use EzPhp\Http\ResponseInterface;

/**
 * Interface ParameterizedMiddlewareInterface
 *
 * Middleware that accepts per-registration parameters. A route or global entry
 * written as `'name:arg1,arg2'` (class name or alias, a colon, comma-separated
 * values) is resolved from the container once and called with those values as
 * extra string arguments, so one middleware class can serve differently
 * configured routes while registrations stay plain strings (route:cache-safe).
 *
 * Parameters are always strings; the middleware converts them itself. When no
 * parameters are given, `$parameters` is empty.
 *
 * @package EzPhp\Contracts
 */
interface ParameterizedMiddlewareInterface extends MiddlewareInterface
{
    /**
     * Handle the incoming request and return a response.
     *
     * @param RequestInterface $request
     * @param callable         $next
     * @param string           ...$parameters Values from the `name:arg1,arg2` registration, in order.
     *
     * @return ResponseInterface
     */
    public function handle(RequestInterface $request, callable $next, string ...$parameters): ResponseInterface;
}
