<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

use EzPhp\Http\RequestInterface;
use EzPhp\Http\ResponseInterface;
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
     * Record the exception (log, metrics, …) without producing a response.
     *
     * Called by the kernel before render(), and on its own when a streamed
     * response fails after its headers were already sent. Implementations must
     * not throw.
     *
     * @param Throwable        $e
     * @param RequestInterface $request
     *
     * @return void
     */
    public function report(Throwable $e, RequestInterface $request): void;

    /**
     * Convert the given exception to an HTTP Response.
     *
     * @param Throwable        $e
     * @param RequestInterface $request
     *
     * @return ResponseInterface
     */
    public function render(Throwable $e, RequestInterface $request): ResponseInterface;
}
