<?php

namespace Fls\Macros\Macros\Stringable;

use Fls\Macros\Macros\Str\NumbersOnly as StrNumbersOnly;
use Illuminate\Support\Stringable;

/**
 * Replace non-ASCII digits in a string.
 *
 * @mixin Stringable
 */
class NumbersOnly
{
    public function __invoke()
    {
        return function (string $filler = ''): Stringable {
            /** @var Stringable $stringable */
            $stringable = $this;
            $replaceNonDigits = (new StrNumbersOnly())();

            return new Stringable($replaceNonDigits($stringable->value(), $filler));
        };
    }
}
