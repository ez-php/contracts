<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Interface RouterInterface
 *
 * Route registration and the serialisable route list — the part of the router
 * that modules need to expose an endpoint (`/health`, `/metrics`, `/graphql`,
 * `/openapi.json`, …) or document the routes, without depending on the
 * framework's concrete Router class. Implemented by `EzPhp\Routing\Router` and
 * bound by the framework's `RouterServiceProvider`.
 *
 * Registration methods return the created route object; its concrete type is
 * framework-specific, so callers that only register a route ignore it.
 *
 * @package EzPhp\Contracts
 */
interface RouterInterface
{
    /**
     * @param string                               $path
     * @param callable|array{class-string, string} $handler
     *
     * @return object The registered route.
     */
    public function get(string $path, callable|array $handler): object;

    /**
     * @param string                               $path
     * @param callable|array{class-string, string} $handler
     *
     * @return object The registered route.
     */
    public function post(string $path, callable|array $handler): object;

    /**
     * @param string                               $path
     * @param callable|array{class-string, string} $handler
     *
     * @return object The registered route.
     */
    public function put(string $path, callable|array $handler): object;

    /**
     * @param string                               $path
     * @param callable|array{class-string, string} $handler
     *
     * @return object The registered route.
     */
    public function patch(string $path, callable|array $handler): object;

    /**
     * @param string                               $path
     * @param callable|array{class-string, string} $handler
     *
     * @return object The registered route.
     */
    public function delete(string $path, callable|array $handler): object;

    /**
     * Export every route registered as `[Controller::class, 'method']` as a
     * serialisable list. Closure routes cannot be serialised and are skipped.
     *
     * @return list<array{method: string, path: string, name: string|null, handler: array{0: class-string, 1: string}, middleware: array<int, non-empty-string>, constraints: array<string, string>, csrfExempt: bool}>
     */
    public function toCache(): array;
}
