<?php

namespace Fls\Macros\Macros\Str;

use Illuminate\Support\Str;

/**
 * Decode a string from base64.
 *
 * @mixin Str
 *
 * @param string $filename
 * @param string $placeholder
 * @return string
 */
class FromBase64
{
    public function __invoke()
    {
        return fn (string $value) => base64_decode($value);
    }
}
