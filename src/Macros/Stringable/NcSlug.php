<?php

namespace Fls\Macros\Macros\Stringable;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * Recode the string into a reliable slug.
 *
 * @mixin Stringable
 */
class NcSlug
{
    public function __invoke()
    {
        return function (string $separator = '-') {
            return new static(Str::ncSlug($this->value, $separator));
        };
    }
}
