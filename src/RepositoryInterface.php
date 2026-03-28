<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Interface RepositoryInterface
 *
 * Minimal contract for Data Mapper repositories. Typed against the managed entity
 * class via the T template so that other modules can type-check against this
 * interface without importing ez-php/orm.
 *
 * @template T of object
 *
 * @package EzPhp\Contracts
 */
interface RepositoryInterface
{
    /**
     * Find an entity by its primary key. Returns null when not found.
     *
     * @param int|string $id
     *
     * @return T|null
     */
    public function find(int|string $id): ?object;

    /**
     * Persist an entity.
     *
     * INSERT when the entity has no primary key; UPDATE only dirty columns otherwise.
     *
     * @param T $entity
     *
     * @return void
     */
    public function save(object $entity): void;

    /**
     * Delete an entity from storage.
     *
     * Soft-delete if the entity class has soft-deletes enabled; hard-delete otherwise.
     *
     * @param T $entity
     *
     * @return void
     */
    public function delete(object $entity): void;
}
