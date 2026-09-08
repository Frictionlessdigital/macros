<?php

namespace Fls\Macros\Macros\Collection;

use Coduo\PHPHumanizer\CollectionHumanizer;
use Illuminate\Support\Collection;

/**
 * @mixin Collection
 */
class Oxford
{
    /**
     * @return \Closure
     */
    public function __invoke()
    {
        /*
         * @param int|null $limit
         * @param string $locale
         *
         * @var \Illuminate\Support\Collection $this
         *
         * @return string
         */
        return function (?int $limit = null, string $locale = 'en') {
            $values = $this->filter()->unique()->values();
            $count = $values->count();

            $limit = match (true) {
                min($limit, $count) == $count => null,
                $limit == $count => null,
                default => $limit,
            };

            return CollectionHumanizer::oxford(
                collection: $values->all(),
                limit: $limit,
                locale: $locale
            );
        };
    }
}
