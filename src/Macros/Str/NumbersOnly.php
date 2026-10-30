<?php

namespace Fls\Macros\Macros\Str;

use Illuminate\Support\Str;

/**
 * Replace non-ASCII digits in a string.
 *
 * @mixin Str
 */
class NumbersOnly
{
    public function __invoke()
    {
        return function (string $value, string $filler = ''): string {
            return preg_replace('/[^0-9]/', $filler, $value);
        };
    }
}
