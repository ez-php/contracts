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
}
