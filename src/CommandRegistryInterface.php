<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Interface CommandRegistryInterface
 *
 * Allows service providers to register console commands without depending
 * on the concrete Application class.
 *
 * @package EzPhp\Contracts
 */
interface CommandRegistryInterface
{
    /**
     * Register a console command class.
     *
     * @param class-string $commandClass
     *
     * @return static
     */
    public function registerCommand(string $commandClass): static;

    /**
     * Return all registered command class names.
     *
     * @return list<class-string>
     */
    public function getCommands(): array;
}
