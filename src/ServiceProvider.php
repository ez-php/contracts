<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Class ServiceProvider
 *
 * Abstract base for all service providers. Uses ContainerInterface so that
 * module providers do not depend on the concrete Application class.
 *
 * @package EzPhp\Contracts
 */
abstract class ServiceProvider
{
    /**
     * ServiceProvider Constructor
     *
     * @param ContainerInterface $app
     */
    public function __construct(
        protected readonly ContainerInterface $app
    ) {
        //
    }

    /**
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        //
    }

    /**
     * Indicate whether this provider is deferred (lazy).
     *
     * When true, the provider's register() and boot() are not called during
     * bootstrap. Instead, they are called the first time any of the bindings
     * declared in provides() is requested from the container.
     *
     * @return bool
     */
    public function deferred(): bool
    {
        return false;
    }

    /**
     * Return the list of bindings (class-strings) that this deferred provider
     * registers. The Application uses this list to know when to activate the
     * provider. This method is only meaningful when deferred() returns true.
     *
     * @return list<string>
     */
    public function provides(): array
    {
        return [];
    }
}
