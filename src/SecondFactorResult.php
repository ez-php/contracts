<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Outcome of a second-factor verification attempt (2FA, passkey, or any
 * other second-factor mechanism).
 *
 * A single shared result type any second-factor-verifying module can return,
 * so application-level login-flow code can branch on one outcome regardless
 * of which mechanism produced it. It carries no verification logic of its
 * own — deliberately, since `ez-php/contracts` ships interfaces and pure
 * data types only, never implementation.
 *
 * @package EzPhp\Contracts
 */
enum SecondFactorResult
{
    /** The second factor was presented and verified successfully. */
    case Satisfied;

    /** The second factor was presented but failed verification. */
    case NotSatisfied;

    /** The user has no second factor configured for this mechanism. */
    case NotConfigured;
}
