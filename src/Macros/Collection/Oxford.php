<?php

namespace Fls\Macros\Macros\Collection;

use Coduo\PHPHumanizer\CollectionHumanizer;

/**
 * @mixin \Illuminate\Support\Collection
 */
class Oxford
{
    /**
     * @return \Closure
     */
    public function __invoke()
    {
        /*
         * @param mixed $key
         * @param int|null $limit
         * @param string $locale
         * @return string
         */
        return function ($key, int $limit = null, string $locale = 'en') {
            // fetch values
            $values = $this->pluck($key)->filter()->unique()->values()->all();
            // oxfordize
            return CollectionHumanizer::oxford($values, $limit, $locale);
        };
    }
}
