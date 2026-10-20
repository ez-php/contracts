<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Interface GateInterface
 *
 * Authorization check for the acting user: may they perform an ability,
 * optionally on a subject (an object or a class-string)? Implemented by
 * ez-php/authorization's Gate and consumed by ez-php/framework's
 * `Controller::authorize()`, so the framework can authorize without
 * depending on the authorization module.
 *
 * @package EzPhp\Contracts
 */
interface GateInterface
{
    /**
     * Return true when the current user may perform the ability.
     *
     * @param string $ability Ability name, e.g. 'update'.
     * @param mixed  $subject Optional subject (object or class-string).
     *
     * @return bool
     */
    public function allows(string $ability, mixed $subject = null): bool;
}
