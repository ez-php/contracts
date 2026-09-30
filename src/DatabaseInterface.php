<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

use PDO;
use Throwable;

/**
 * Interface DatabaseInterface
 *
 * Minimal contract for the database connection. Covers SELECT queries,
 * transactional DML, and raw PDO access for advanced use cases.
 *
 * @package EzPhp\Contracts
 */
interface DatabaseInterface
{
    /**
     * Execute a SELECT query and return all matching rows.
     *
     * @param string                   $sql
     * @param array<int|string, mixed> $bindings Positional or named bindings.
     *
     * @return list<array<string, mixed>>
     */
    public function query(string $sql, array $bindings = []): array;

    /**
     * Execute a non-SELECT statement (INSERT, UPDATE, DELETE) and return the number of affected rows.
     *
     * @param string                   $sql
     * @param array<int|string, mixed> $bindings Positional or named bindings.
     *
     * @return int Number of rows affected.
     */
    public function execute(string $sql, array $bindings = []): int;

    /**
     * Execute a callable inside a database transaction.
     * Rolls back automatically on exception; commits otherwise.
     *
     * Nesting: when a transaction is already open on the connection (an outer
     * transaction() call, or one begun directly on the PDO), implementations
     * must not begin a second one. The reference implementation runs the
     * callable inside a SAVEPOINT: an exception rolls back only to that
     * savepoint and is rethrown; success releases it, and the outermost
     * transaction decides the final commit.
     *
     * @template T
     *
     * @param callable(): T $fn
     *
     * @return T
     * @throws Throwable
     */
    public function transaction(callable $fn): mixed;

    /**
     * Return the underlying PDO connection.
     *
     * @return PDO
     */
    public function getPdo(): PDO;
}
