<?php

namespace Fls\Macros\Macros\Stringable;

use Illuminate\Support\Str;

/**
 * Sanitize the string to be a safe filename.
 *
 * @param string $placeholder
 * @mixin \Illuminate\Support\Stringable
 * @return \Illuminate\Support\Stringable
 */
class SafeFilename
{
    public function __invoke()
    {
        return function ($placeholder = '') {
            return new static(Str::safeFilename($this->value, $placeholder));
        };
    }
}
