<?php

declare(strict_types=1);

namespace Tests;

use EzPhp\Contracts\CommandRegistryInterface;
use EzPhp\Contracts\ContainerInterface;
use EzPhp\Contracts\ServiceProvider;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Container that is only a ContainerInterface (e.g. a test double).
 */
class ServiceProviderCommandPlainContainer implements ContainerInterface
{
    public function bind(string $abstract, string|callable|null $factory = null): static
    {
        return $this;
    }

    public function make(string $abstract): mixed
    {
        throw new \RuntimeException('not used');
    }

    public function has(string $abstract): bool
    {
        return false;
    }

    public function instance(string $abstract, object $instance): void
    {
    }
}

/**
 * Container that also registers commands, like the framework's Application.
 */
final class ServiceProviderCommandRegistryContainer extends ServiceProviderCommandPlainContainer implements CommandRegistryInterface
{
    /** @var list<class-string> */
    public array $commands = [];

    public function registerCommand(string $commandClass): static
    {
        $this->commands[] = $commandClass;

        return $this;
    }

    public function getCommands(): array
    {
        return $this->commands;
    }
}

/**
 * Provider exposing the protected helper for the test.
 */
final class ServiceProviderCommandProbe extends ServiceProvider
{
    /**
     * @param class-string $commandClass
     */
    public function add(string $commandClass): bool
    {
        return $this->registerCommand($commandClass);
    }
}

/**
 * ServiceProvider::registerCommand() forwards to CommandRegistryInterface, so
 * providers typed against ContainerInterface need no Application narrowing.
 *
 * @package Tests
 */
#[CoversClass(ServiceProvider::class)]
final class ServiceProviderCommandTest extends TestCase
{
    public function test_register_command_forwards_to_a_command_registry(): void
    {
        $container = new ServiceProviderCommandRegistryContainer();

        self::assertTrue((new ServiceProviderCommandProbe($container))->add(\stdClass::class));
        self::assertSame([\stdClass::class], $container->getCommands());
    }

    public function test_register_command_is_a_noop_without_a_command_registry(): void
    {
        self::assertFalse((new ServiceProviderCommandProbe(new ServiceProviderCommandPlainContainer()))->add(\stdClass::class));
    }
}
