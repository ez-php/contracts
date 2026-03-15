<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

use RuntimeException;

/**
 * Class EzPhpException
 *
 * Base exception for the ez-php framework and its modules.
 * Extend this class to create module-specific exceptions that can be caught
 * generically by framework-level exception handlers.
 *
 * @package EzPhp\Contracts
 */
class EzPhpException extends RuntimeException
{
}
