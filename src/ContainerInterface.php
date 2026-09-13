<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Interface ContainerInterface
 *
 * Minimal contract for the dependency injection container.
 * Provides bind() and make() so ServiceProviders can register and resolve
 * services without depending on the concrete Application class.
 *
 * @package EzPhp\Contracts
 */
interface ContainerInterface
{
    /**
     * Register a binding in the container.
     *
     * @param string                   $abstract Class or interface name.
     * @param string|callable|null     $factory  Concrete class, factory callable, or null for self-binding.
     *
     * @return static
     */
    public function bind(string $abstract, string|callable|null $factory = null): static;

    /**
     * Resolve a class from the container.
     *
     * @template T of object
     * @param class-string<T> $abstract
     *
     * @return T
     */
    public function make(string $abstract): mixed;

    /**
     * Determine whether an explicit binding or resolved instance exists for
     * the given abstract, without attempting to resolve it.
     *
     * Does not report on autowireable concrete classes — only on classes
     * that have been explicitly bound or resolved/cached. Intended for
     * service providers to check for optional dependencies without relying
     * on a broad `try { make() } catch (\Throwable)` probe.
     *
     * @param string $abstract Class or interface name.
     *
     * @return bool
     */
    public function has(string $abstract): bool;

    /**
     * Register an existing object as a shared instance in the container.
     * Bypasses bindings and directly stores the instance in the singleton cache,
     * allowing decorators to replace a previously resolved service in boot().
     *
     * @template T of object
     * @param class-string<T> $abstract
     * @param T               $instance
     *
     * @return void
     */
    public function instance(string $abstract, object $instance): void;
}
