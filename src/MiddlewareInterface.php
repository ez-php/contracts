<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

use EzPhp\Http\Request;
use EzPhp\Http\Response;

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
     * @param Request  $request
     * @param callable $next
     *
     * @return Response
     */
    public function handle(Request $request, callable $next): Response;
}
