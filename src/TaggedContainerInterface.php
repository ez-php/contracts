<?php

declare(strict_types=1);

namespace EzPhp\Contracts;

/**
 * Interface TaggedContainerInterface
 *
 * Service tagging — group class strings under a name and resolve the whole
 * group later (health probes, plugins). Lets modules consume tags without
 * depending on the framework's concrete Container class.
 *
 * @package EzPhp\Contracts
 */
interface TaggedContainerInterface
{
    /**
     * Tag one or more class strings under a named group.
     *
     * @param list<class-string>|class-string $abstracts
     * @param string                          $tag
     *
     * @return void
     */
    public function tag(array|string $abstracts, string $tag): void;

    /**
     * Resolve all services registered under the given tag.
     *
     * @param string $tag
     *
     * @return iterable<object>
     */
    public function tagged(string $tag): iterable;
}
