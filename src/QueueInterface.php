<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Interface QueueInterface
 *
 * Unified contract for all queue drivers (database, Redis, etc.).
 *
 * @package EzPhp\Contracts
 */
interface QueueInterface
{
    /**
     * Push a job onto its configured queue.
     *
     * The target queue is determined by $job->getQueue(). Drivers should
     * honour $job->getDelay() by making the job available only after the
     * specified number of seconds.
     *
     * @param JobInterface $job
     *
     * @return void
     */
    public function push(JobInterface $job): void;

    /**
     * Pop and return the next available job from the given queue.
     *
     * Returns null if the queue is empty or no job is currently available.
     *
     * @param string $queue
     *
     * @return JobInterface|null
     */
    public function pop(string $queue = 'default'): ?JobInterface;

    /**
     * Return the number of pending (not yet reserved) jobs in the queue.
     *
     * @param string $queue
     *
     * @return int
     */
    public function size(string $queue = 'default'): int;

    /**
     * Record a job as permanently failed after all retry attempts are exhausted.
     *
     * Drivers may persist the failure to a failed-jobs table, a Redis list,
     * or any other store. The default implementation may be a no-op.
     *
     * @param JobInterface $job
     * @param \Throwable   $exception
     *
     * @return void
     */
    public function failed(JobInterface $job, \Throwable $exception): void;
}
