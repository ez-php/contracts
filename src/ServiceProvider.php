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
     * Register a console command with the container, when it is a command registry.
     *
     * `$app` is typed as ContainerInterface, so providers would otherwise need an
     * `instanceof CommandRegistryInterface` check (or an Application narrowing)
     * before every registerCommand() call. In a container that is not a registry
     * (a test double, a non-console setup) this is a no-op, like the check it replaces.
     *
     * @param class-string $commandClass
     *
     * @return bool Whether the command was registered.
     */
    protected function registerCommand(string $commandClass): bool
    {
        if (!$this->app instanceof CommandRegistryInterface) {
            return false;
        }

        $this->app->registerCommand($commandClass);

        return true;
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
