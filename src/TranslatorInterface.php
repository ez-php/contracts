<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Interface TranslatorInterface
 *
 * Contract for translation services. Resolves a dot-notation key
 * to a localised string, substituting :placeholder values.
 *
 * @package EzPhp\Contracts
 */
interface TranslatorInterface
{
    /**
     * Resolve a translation key with optional placeholder replacement.
     *
     * @param array<string, string|int|float> $replacements
     */
    public function get(string $key, array $replacements = []): string;
}
