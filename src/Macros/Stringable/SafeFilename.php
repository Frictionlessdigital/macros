<?php

namespace Fls\Macros\Macros\Stringable;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * Sanitize the string to be a safe filename.
 *
 * @param string $placeholder
 * @mixin Stringable
 * @return Stringable
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
