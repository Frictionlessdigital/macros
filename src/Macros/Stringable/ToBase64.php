<?php

namespace Fls\Macros\Macros\Stringable;

use Illuminate\Support\Str;

/**
 * Encode the string into base64.
 *
 * @param string $string
 * @mixin \Illuminate\Support\Stringable
 * @return \Illuminate\Support\Stringable
 */
class ToBase64
{
    public function __invoke()
    {
        return fn () => new static(Str::toBase64($this->value));
    }
}
