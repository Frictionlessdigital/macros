<?php

namespace Fls\Macros\Tests\Stringable;

use Fls\Macros\Tests\TestCase;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class NcSlugTest extends TestCase
{
    #[Test]
    #[DataProvider('slugProvider')]
    public function it_will_create_a_slug(string $expected, string $value, string $separator = '-'): void
    {
        $slug = Str::of($value)->ncSlug($separator);

        $this->assertInstanceOf(Stringable::class, $slug);
        $this->assertSame($expected, (string) $slug);
    }

    public static function slugProvider(): array
    {
        return [
            'default separator' => ['Creme-brulee', ' Crème -- brûlée! '],
            'underscore separator' => ['one_two_three', 'one-two three', '_'],
            'period separator' => ['one.two', 'one-- two', '.'],
            'empty input' => ['', ''],
        ];
    }

    #[Test]
    public function it_will_remain_chainable(): void
    {
        $this->assertSame('Hello-World-2026', (string) Str::of('Hello World')->ncSlug()->append('-2026'));
    }
}
