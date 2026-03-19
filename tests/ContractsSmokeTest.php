<?php

declare(strict_types=1);

namespace Tests;

use EzPhp\Contracts\ConfigInterface;
use EzPhp\Contracts\ContainerInterface;
use EzPhp\Contracts\DatabaseInterface;
use EzPhp\Contracts\ExceptionHandlerInterface;
use EzPhp\Contracts\EzPhpException;
use EzPhp\Contracts\MiddlewareInterface;
use EzPhp\Contracts\ServiceProvider;
use EzPhp\Contracts\TranslatorInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;

/**
 * @package Tests
 */
#[CoversClass(EzPhpException::class)]
#[CoversClass(ServiceProvider::class)]
class ContractsSmokeTest extends TestCase
{
    #[Test]
    public function contractInterfacesExist(): void
    {
        $this->assertTrue(interface_exists(ContainerInterface::class));
        $this->assertTrue(interface_exists(ConfigInterface::class));
        $this->assertTrue(interface_exists(DatabaseInterface::class));
        $this->assertTrue(interface_exists(ExceptionHandlerInterface::class));
        $this->assertTrue(interface_exists(MiddlewareInterface::class));
        $this->assertTrue(interface_exists(TranslatorInterface::class));
    }

    #[Test]
    public function serviceProviderIsAbstract(): void
    {
        $reflection = new \ReflectionClass(ServiceProvider::class);
        $this->assertTrue($reflection->isAbstract());
    }

    #[Test]
    public function ezPhpExceptionIsInstantiable(): void
    {
        $e = new EzPhpException('test');
        $this->assertSame('test', $e->getMessage());
    }

    #[Test]
    public function containerInterfaceBindReturnsSelf(): void
    {
        $container = new class () implements ContainerInterface {
            public function bind(string $abstract, string|callable|null $factory = null): static
            {
                return $this;
            }

            public function make(string $abstract): mixed
            {
                throw new \LogicException('not implemented in test stub');
            }

            public function instance(string $abstract, object $instance): void
            {
            }
        };

        $result = $container->bind('Foo');
        $this->assertSame($container, $result);
    }

    #[Test]
    public function serviceProviderCanBeExtended(): void
    {
        $container = new class () implements ContainerInterface {
            public function bind(string $abstract, string|callable|null $factory = null): static
            {
                return $this;
            }

            public function make(string $abstract): mixed
            {
                throw new \LogicException('not implemented in test stub');
            }

            public function instance(string $abstract, object $instance): void
            {
            }
        };

        $provider = new class ($container) extends ServiceProvider {
            public function register(): void
            {
            }
        };

        $this->assertInstanceOf(ServiceProvider::class, $provider);
    }
}
