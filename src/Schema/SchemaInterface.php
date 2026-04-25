<?php

declare(strict_types=1);

namespace EzPhp\Contracts\Schema;

use Closure;

/**
 * Interface SchemaInterface
 *
 * @package EzPhp\Contracts\Schema
 */
interface SchemaInterface
{
    /**
     * @param string  $table
     * @param Closure $callback
     *
     * @return void
     */
    public function create(string $table, Closure $callback): void;

    /**
     * @param string  $table
     * @param Closure $callback
     *
     * @return void
     */
    public function table(string $table, Closure $callback): void;

    /**
     * @param string $table
     *
     * @return void
     */
    public function drop(string $table): void;

    /**
     * @param string $table
     *
     * @return void
     */
    public function dropIfExists(string $table): void;

    /**
     * @param string $table
     *
     * @return bool
     */
    public function hasTable(string $table): bool;

    /**
     * @param string $table
     * @param string $column
     *
     * @return bool
     */
    public function hasColumn(string $table, string $column): bool;

    /**
     * @param string $from
     * @param string $to
     *
     * @return void
     */
    public function rename(string $from, string $to): void;
}
