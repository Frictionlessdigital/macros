<?php

namespace Fls\Macros\Macros\Stringable;

use Illuminate\Support\Str;

/**
 * Decode string from base64.
 *
 * @param string $string
 * @mixin \Illuminate\Support\Stringable
 * @return \Illuminate\Support\Stringable
 */
class FromBase64
{
    public function __invoke()
    {
        return fn () => new static(Str::fromBase64($this->value));
    }
}
