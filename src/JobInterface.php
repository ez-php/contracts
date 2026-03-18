<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Interface JobInterface
 *
 * Contract for all queue jobs. A job encapsulates a unit of work that can be
 * dispatched to a queue driver and executed asynchronously by a Worker.
 *
 * @package EzPhp\Contracts
 */
interface JobInterface
{
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void;

    /**
     * Called when the job throws an exception during execution.
     *
     * Override in concrete jobs to send notifications, log details,
     * or perform cleanup. The default implementation is a no-op.
     *
     * @param \Throwable $exception
     *
     * @return void
     */
    public function fail(\Throwable $exception): void;

    /**
     * Return the name of the queue this job should be pushed onto.
     *
     * @return string
     */
    public function getQueue(): string;

    /**
     * Return the number of seconds to wait before the job becomes available.
     *
     * @return int
     */
    public function getDelay(): int;

    /**
     * Return the maximum number of times this job may be attempted.
     *
     * @return int
     */
    public function getMaxTries(): int;

    /**
     * Return the number of times this job has already been attempted.
     *
     * @return int
     */
    public function getAttempts(): int;

    /**
     * Increment the attempt counter by one.
     *
     * Called by the Worker before each execution attempt.
     *
     * @return void
     */
    public function incrementAttempts(): void;
}
