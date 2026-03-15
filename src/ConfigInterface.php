<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Interface ConfigInterface
 *
 * Minimal contract for reading configuration values via dot-notation keys.
 *
 * @package EzPhp\Contracts
 */
interface ConfigInterface
{
    /**
     * Retrieve a configuration value by dot-notation key.
     *
     * @param string $key     Dot-notation key (e.g. 'app.debug', 'db.host').
     * @param mixed  $default Returned when the key is absent.
     *
     * @return mixed
     */
    public function get(string $key, mixed $default = null): mixed;
}
