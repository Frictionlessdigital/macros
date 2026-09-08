<?php

namespace Fls\Macros\Macros\Str;

use Illuminate\Support\Str;

/**
 * Encode a string as base64.
 *
 * @mixin Str
 *
 * @param string $filename
 * @param string $placeholder
 * @return string
 */
class ToBase64
{
    public function __invoke()
    {
        return fn (string $value) => base64_encode($value);
    }
}
