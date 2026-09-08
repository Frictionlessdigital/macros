<?php

namespace Fls\Macros\Macros\Collection;

use Illuminate\Support\Collection;

/**
 * @mixin Collection
 */
class OxfordByKey
{
    /**
     * @return \Closure
     */
    public function __invoke()
    {
        /*
         * @param string|null $key
         * @param int|null $limit
         * @param string $locale
         *
         * @var \Illuminate\Support\Collection $this
         *
         * @return string
         */
        return function ($key, ?int $limit = null, string $locale = 'en') {
            // fetch values
            return $this->pluck($key)
                ->filter()
                ->unique()
                ->values()
                ->oxford($limit, $locale);
        };
    }
}
