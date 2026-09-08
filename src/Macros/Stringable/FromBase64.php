<?php

namespace Fls\Macros\Macros\Stringable;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * Decode string from base64.
 *
 * @param string $string
 * @mixin Stringable
 * @return Stringable
 */
class FromBase64
{
    public function __invoke()
    {
        return fn () => new static(Str::fromBase64($this->value));
    }
}
