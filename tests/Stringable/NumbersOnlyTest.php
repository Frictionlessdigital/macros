<?php

namespace Fls\Macros\Tests\Stringable;

use Fls\Macros\Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class NumbersOnlyTest extends TestCase
{
    #[Test]
    #[DataProvider('numbersOnlyProvider')]
    public function it_will_replace_non_digits(string $expected, string $value, string $filler = ''): void
    {
        $result = Str::of($value)->numbersOnly($filler);

        $this->assertInstanceOf(Stringable::class, $result);
        $this->assertSame($expected, (string) $result);
    }

    public static function numbersOnlyProvider(): array
    {
        return [
            'digits remain unchanged' => ['12345', '12345'],
            'non-digits are removed by default' => ['12345', ' (123) 45-abc'],
            'each non-digit uses the filler' => ['*12**3', 'a12--3', '*'],
            'empty input' => ['', ''],
        ];
    }

    #[Test]
    public function it_will_remain_chainable(): void
    {
        $this->assertSame('12345', (string) Str::of('(123) 4')->numbersOnly()->append('5'));
    }
}
