<?php

namespace Fls\Macros\Tests\Str;

use Fls\Macros\Tests\TestCase;
use Illuminate\Support\Str;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class NumbersOnlyTest extends TestCase
{
    #[Test]
    #[DataProvider('numbersOnlyProvider')]
    public function it_will_replace_non_digits(string $expected, string $value, string $filler = ''): void
    {
        $this->assertSame($expected, Str::numbersOnly($value, $filler));
    }

    public static function numbersOnlyProvider(): array
    {
        return [
            'digits remain unchanged' => ['12345', '12345'],
            'non-digits are removed by default' => ['12345', ' (123) 45-abc'],
            'each non-digit uses the filler' => ['*12**3', 'a12--3', '*'],
            'empty input' => ['', ''],
            'input without digits' => ['', 'abc'],
            'non-ASCII numerals are removed' => ['12', '1٢2'],
        ];
    }
}
