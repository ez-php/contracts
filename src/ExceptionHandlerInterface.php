<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

use EzPhp\Http\RequestInterface;
use EzPhp\Http\Response;
use Throwable;

/**
 * Interface ExceptionHandlerInterface
 *
 * Contract for converting an unhandled exception into an HTTP response.
 *
 * @package EzPhp\Contracts
 */
interface ExceptionHandlerInterface
{
    /**
     * Convert the given exception to an HTTP Response.
     *
     * @param Throwable        $e
     * @param RequestInterface $request
     *
     * @return Response
     */
    public function render(Throwable $e, RequestInterface $request): Response;
}
