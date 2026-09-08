<?php

namespace Fls\Macros\Macros\Stringable;

use Illuminate\Support\Str;
use Illuminate\Support\Stringable;

/**
 * Encode the string into base64.
 *
 * @param string $string
 * @mixin Stringable
 * @return Stringable
 */
class ToBase64
{
    public function __invoke()
    {
        return fn () => new static(Str::toBase64($this->value));
    }
}
