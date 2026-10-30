<?php

namespace Fls\Macros\Macros\Str;

use Illuminate\Support\Str;

/**
 * Recode a string into a reliable slug
 *
 * @mixin Str
 *
 * @param string $value
 * @param string $separator
 * @return string
 */
class NcSlug
{
    public function __invoke()
    {
        return function (string $value, string $separator = '-') {
            $flip = $separator === '-' ? '_' : '-';

            return Str::of($value)
                ->ascii()
                ->replace($flip, $separator)
                ->replaceMatches('/[^' . preg_quote($separator, '/') . '\pL\pN\s]+/u', '')
                ->replaceMatches('/[' . preg_quote($separator, '/') . '\s]+/u', $separator)
                ->trim($separator)
                ->toString();
        };
    }
}
