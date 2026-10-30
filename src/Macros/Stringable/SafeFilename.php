<?php

namespace Fls\Macros\Macros\Stringable;

use Fls\Macros\Macros\Str\SafeFilename as StrSafeFilename;
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
        return function (string $placeholder = ''): Stringable {
            /** @var Stringable $stringable */
            $stringable = $this;
            $sanitize = (new StrSafeFilename())();

            return new Stringable($sanitize($stringable->value(), $placeholder));
        };
    }
}
