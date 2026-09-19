<?php

declare(strict_types=1);

namespace Tests;

use EzPhp\Contracts\SecondFactorResult;
use PHPUnit\Framework\Attributes\CoversClass;

/**
 * Class SecondFactorResultTest
 *
 * @package Tests
 */
#[CoversClass(SecondFactorResult::class)]
final class SecondFactorResultTest extends TestCase
{
    public function testHasExactlyTheThreeExpectedCases(): void
    {
        $names = array_map(static fn (SecondFactorResult $c): string => $c->name, SecondFactorResult::cases());

        $this->assertSame(['Satisfied', 'NotSatisfied', 'NotConfigured'], $names);
    }

    public function testCasesAreDistinct(): void
    {
        $this->assertNotSame(SecondFactorResult::Satisfied, SecondFactorResult::NotSatisfied);
        $this->assertNotSame(SecondFactorResult::Satisfied, SecondFactorResult::NotConfigured);
        $this->assertNotSame(SecondFactorResult::NotSatisfied, SecondFactorResult::NotConfigured);
    }
}
